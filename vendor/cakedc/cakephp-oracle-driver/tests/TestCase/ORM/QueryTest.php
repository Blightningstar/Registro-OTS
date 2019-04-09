<?php
/**
 * Copyright 2015 - 2016, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2015 - 2016, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

namespace CakeDC\OracleDriver\Test\TestCase\ORM;

use Cake\Database\Expression\IdentifierExpression;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\TableRegistry;
use Cake\Test\TestCase\ORM\QueryTest as CakeQueryTest;


/**
 * Tests Query class
 *
 */
class QueryTest extends CakeQueryTest
{

    /**
     * Fixture to be used
     *
     * @var array
     */
    public $fixtures = [
        'core.articles',
        'core.tags',
        'core.articles_tags',
        'core.authors',
        'core.comments',
        'core.posts',
    ];

    /**
     * Test that addFields() works in the basic case.
     *
     * @return void
     */
    public function testAutoFields()
    {
        $table = TableRegistry::get('Articles');
        $result = $table->find('all')
            ->select(['myField' => '(SELECT 20 FROM DUAL)'])
            ->autoFields(true)
            ->hydrate(false)
            ->first();

        $this->assertArrayHasKey('myField', $result);
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('title', $result);
    }

    /**
     * Test autoFields with auto fields.
     *
     * @return void
     */
    public function testAutoFieldsWithAssociations()
    {
        $table = TableRegistry::get('Articles');
        $table->belongsTo('Authors');

        $result = $table->find()
            ->select(['myField' => '(SELECT 2 + 2 FROM DUAL)'])
            ->autoFields(true)
            ->hydrate(false)
            ->contain('Authors')
            ->first();

        $this->assertArrayHasKey('myField', $result);
        $this->assertArrayHasKey('title', $result);
        $this->assertArrayHasKey('author', $result);
        $this->assertNotNull($result['author']);
        $this->assertArrayHasKey('name', $result['author']);
    }

    /**
     * Test autoFields in contain query builder
     *
     * @return void
     */
    public function testAutoFieldsWithContainQueryBuilder()
    {
        $table = TableRegistry::get('Articles');
        $table->belongsTo('Authors');

        $result = $table->find()
            ->select(['myField' => '(SELECT 2 + 2 FROM DUAL)'])
            ->autoFields(true)
            ->hydrate(false)
            ->contain([
                'Authors' => function ($q) {
                    return $q->select(['compute' => '(SELECT 2 + 20 FROM DUAL)'])
                             ->autoFields(true);
                }
            ])
            ->first();

        $this->assertArrayHasKey('myField', $result);
        $this->assertArrayHasKey('title', $result);
        $this->assertArrayHasKey('author', $result);
        $this->assertNotNull($result['author']);
        $this->assertArrayHasKey('name', $result['author']);
        $this->assertArrayHasKey('compute', $result);
    }

    /**
     * Test that count() returns correct results with group by.
     *
     * @return void
     */
    public function testCountWithGroup()
    {
        $table = TableRegistry::get('articles');
        $query = $table->find('all');
        $query
            ->select(['author_id',
                's' => $query->func()->sum(new IdentifierExpression('id'))
           ])
          ->group(['author_id']);
        $result = $query->count();
        $this->assertEquals(2, $result);
    }

    /**
     * Tests that it is possible to nest a notMatching call inside another
     * eagerloader function.
     *
     * @return void
     */
    public function testNotMatchingNested()
    {
        $table = TableRegistry::get('authors');
        $articles = $table->hasMany('articles');
        $articles->belongsToMany('tags');

        $results = $table->find()
             ->hydrate(false)
             ->matching('articles', function ($q) {
                 return $q->notMatching('tags', function ($q) {
                     return $q->where(['tags.name' => 'tag3']);
                 });
             })
             ->order(['authors.id' => 'ASC', 'articles.id' => 'ASC']);

        $expected = [
            'id' => 1,
            'name' => 'mariano',
            '_matchingData' => [
                'articles' => [
                    'id' => 1,
                    'author_id' => 1,
                    'title' => 'First Article',
                    'body' => 'First Article Body',
                    'published' => 'Y'
                ]
            ]
        ];
        $this->assertEquals($expected, $results->first());
    }

    /**
     * Tests that leftJoinWith() creates a left join with a given association and
     * that no fields from such association are loaded.
     *
     * @return void
     */
    public function testLeftJoinWith()
    {
        $table = TableRegistry::get('authors');
        $table->hasMany('articles');
        $table->articles->deleteAll(['author_id' => 4]);
        $orderFn = function ($q) {
            return $q->order(['id']);
        };
        $results = $table->find()
             ->select(['total_articles' => 'count(articles.id)'])
             ->autoFields(true)
             ->leftJoinWith('articles', $orderFn)
             ->group(['authors.id', 'authors.name']);

        $expected = [
            1 => 2,
            2 => 0,
            3 => 1,
            4 => 0
        ];
        $this->assertEquals($expected, $results->combine('id', 'total_articles')
                                               ->toArray());
        $fields = ['total_articles', 'id', 'name'];
        $this->assertEquals($fields, array_keys($results->first()->toArray()));

        $results = $table->find()
             ->leftJoinWith('articles', $orderFn)
             ->where(['articles.id IS' => null]);

        $this->assertEquals([2, 4], $results->sortBy('id', SORT_ASC)->extract('id')
                                            ->toList());
        $this->assertEquals(['id', 'name'], array_keys($results->first()
                                                               ->toArray()));

        $results = $table
            ->find()
            ->leftJoinWith('articles', $orderFn)
            ->where(['articles.id IS NOT' => null])
            ->order(['authors.id']);

        $this->assertEquals([1, 1, 3], $results->sortBy('id', SORT_ASC)->extract('id')
                                               ->toList());
        $this->assertEquals(['id', 'name'], array_keys($results->first()
                                                               ->toArray()));
    }

    /**
     * Tests that it is possible to bind arguments to a query and it will return the right
     * results
     *
     * @return void
     */
    public function testCustomBindings()
    {
        $table = TableRegistry::get('Articles');
        $query = $table->find()->where(['id >' => 1]);
        $query->where(function ($exp) {
            $e = new QueryExpression();
            return $exp->add($e->eq(new IdentifierExpression('author_id'), new IdentifierExpression(':author')));
        });
        $query->bind(':author', 1, 'integer');
        $this->assertEquals(1, $query->count());
        $this->assertEquals(3, $query->first()->id);
    }

    /**
     * Test disabled because on oracle DISTINCT ON syntax does not supported.
     *
     * @return void
     */
    public function testNotMatchingDeep()
    {
    }

    /**
     * Tests that leftJoinWith() can be used with select()
     *
     * @return void
     */
    public function testLeftJoinWithSelect()
    {
        // stub as "DISTINCT ON" not supported in oracle
        // @todo implement Expression class for analytic functions
    }

}
