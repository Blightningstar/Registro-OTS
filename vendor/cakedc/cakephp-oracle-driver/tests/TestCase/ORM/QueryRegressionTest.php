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

use Cake\ORM\TableRegistry;
use Cake\Test\TestCase\ORM\QueryRegressionTest as CakeQueryRegressionTest;


/**
 * Tests QueryRegression class
 *
 */
class QueryRegressionTest extends CakeQueryRegressionTest
{

    /**
     * Test expression based ordering with unions.
     *
     * @return void
     */
    public function testComplexOrderWithUnion()
    {
        $table = TableRegistry::get('Comments');
        $query = $table->find();
        $inner = $table->find()
           ->select(['content' => 'to_char(comment)'])
           ->where(['id >' => 3]);
        $inner2 = $table->find()
            ->select(['content' => 'to_char(comment)'])
            ->where(['id <' => 3]);

        $order = $query->func()
               ->concat(['content' => 'identifier', 'test']);

        $query->select(['inside.content'])
              ->from(['inside' => $inner->unionAll($inner2)])
              ->orderAsc($order);

        $results = $query->toArray();
        $this->assertCount(5, $results);
    }

    /**
     * Test that save() works with entities containing expressions
     * as properties.
     *
     * @return void
     */
    public function testSaveWithExpressionProperty()
    {
        $articles = TableRegistry::get('Articles');
        $article = $articles->newEntity();
        $article->title = new \Cake\Database\Expression\QueryExpression("SELECT 'jose' from DUAL");
        $this->assertSame($article, $articles->save($article));
    }

    /**
     * Tests that using the subquery strategy in a deep association returns the right results
     *
     * @see https://github.com/cakephp/cakephp/issues/4484
     * @return void
     */
    public function testDeepBelongsToManySubqueryStrategy()
    {
        $table = TableRegistry::get('Authors');
        $table->hasMany('Articles');
        $table->Articles->belongsToMany('Tags', [
            'strategy' => 'subquery'
        ]);

        $result = $table->find()
            ->contain([
                'Articles' => [
                    'Tags' => function ($q) {
                        return $q->order(['name']);
                    }
                ]
            ])
            ->toArray();
        $this->assertEquals(['tag1', 'tag3'], collection($result[2]->articles[0]->tags)->extract('name')->toArray());
    }

    /**
     * Tests that using the subquery strategy in a deep association returns the right results
     *
     * @see https://github.com/cakephp/cakephp/issues/5769
     * @return void
     */
    public function testDeepBelongsToManySubqueryStrategy2()
    {
        $table = TableRegistry::get('Authors');
        $table->hasMany('Articles');
        $table->Articles->belongsToMany('Tags', [
            'strategy' => 'subquery'
        ]);
        $table->belongsToMany('Tags', [
            'strategy' => 'subquery',
        ]);
        $table->Articles->belongsTo('Authors');

        $result = $table->Articles
            ->find()
          ->where(['Authors.id >' => 1])
          ->contain([
              'Authors' => [
                  'Tags' => function ($q) {
                      return $q->order(['name']);
                  }
              ]
          ])
          ->toArray();
        $this->assertEquals(['tag1', 'tag2'], collection($result[0]->author->tags)
            ->extract('name')
            ->toArray());
        $this->assertEquals(3, $result[0]->author->id);
    }

    /**
     * such syntax is not supported and leads to ORA-00937
     */
    public function testSubqueryInSelectExpression()
    {
    }

    /**
     * We can use only union all with queries with clob fields
     *
     * @see https://asktom.oracle.com/pls/apex/f?p=100:11:0::::P11_QUESTION_ID:498299691850
     * @return void
     */
    public function testCountWithUnionQuery()
    {
        $table = TableRegistry::get('Articles');
        $query = $table->find()
                       ->where(['id' => 1]);
        $query2 = $table->find()
                        ->where(['id' => 2]);
        $query->unionAll($query2);
        $this->assertEquals(2, $query->count());

        $fields = [
            'id',
            'author_id',
            'title',
            'body' => 'to_char(body)',
            'published'
        ];
        $query = $table->find()
                       ->select($fields)
                       ->where(['id' => 1]);
        $query2 = $table->find()
                        ->select($fields)
                        ->where(['id' => 2]);
        $query->union($query2);
        $this->assertEquals(2, $query->count());
    }

}
