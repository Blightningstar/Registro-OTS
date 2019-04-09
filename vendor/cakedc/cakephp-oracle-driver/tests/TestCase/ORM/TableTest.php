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

use Cake\Database\Expression\FunctionExpression;
use Cake\Database\Expression\IdentifierExpression;
use Cake\ORM\Table;
use Cake\Test\TestCase\ORM\TableTest as CakeTableTest;


/**
 * Tests Table class
 *
 */
class TableTest extends CakeTableTest
{

    public $fixtures = [
        'core.articles',
        'core.tags',
        'core.articles_tags',
        'core.authors',
        'core.categories',
        'core.comments',
        'core.groups',
        'core.members',
        'core.groups_members',
        'core.polymorphic_tagged',
        'core.site_articles',
        'core.users'
    ];

    /**
     * Tests find('list')
     *
     * @return void
     */
    public function testFindListNoHydration()
    {
        $table = new Table([
            'table' => 'users',
            'connection' => $this->connection,
        ]);
        $table->displayField('username');
        $query = $table
            ->find('list')
            ->hydrate(false)
            ->order('id');
        $expected = [
            1 => 'mariano',
            2 => 'nate',
            3 => 'larry',
            4 => 'garrett'
        ];
        $this->assertSame($expected, $query->toArray());

        $query = $table->find('list', ['fields' => ['id', 'username']])
                       ->hydrate(false)
                       ->order('id');
        $expected = [
            1 => 'mariano',
            2 => 'nate',
            3 => 'larry',
            4 => 'garrett'
        ];
        $this->assertSame($expected, $query->toArray());

        $query = $table->find('list', ['groupField' => 'odd'])
           ->select([
               'id',
               'username',
               'odd' => new FunctionExpression('MOD', [new IdentifierExpression('id'), 2])
           ])
           ->hydrate(false)
           ->order('id');
        $expected = [
            1 => [
                1 => 'mariano',
                3 => 'larry'
            ],
            0 => [
                2 => 'nate',
                4 => 'garrett'
            ]
        ];
        $this->assertSame($expected, $query->toArray());
    }

    /**
     * Tests find('list') with hydrated records
     *
     * @return void
     */
    public function testFindListHydrated()
    {
        $table = new Table([
            'table' => 'users',
            'connection' => $this->connection,
        ]);
        $table->displayField('username');
        $query = $table->find('list', ['fields' => ['id', 'username']])
                       ->order('id');
        $expected = [
            1 => 'mariano',
            2 => 'nate',
            3 => 'larry',
            4 => 'garrett'
        ];
        $this->assertSame($expected, $query->toArray());

        $query = $table->find('list', ['groupField' => 'odd'])
           ->select([
               'id',
               'username',
               'odd' => new FunctionExpression('MOD', [new IdentifierExpression('id'), 2])
           ])
           ->hydrate(true)
           ->order('id');
        $expected = [
            1 => [
                1 => 'mariano',
                3 => 'larry'
            ],
            0 => [
                2 => 'nate',
                4 => 'garrett'
            ]
        ];
        $this->assertSame($expected, $query->toArray());
    }

    /**
     * Test that the associated entities are unlinked and deleted when they have a not nullable foreign key
     *
     * @return void
     */
    public function testSaveReplaceSaveStrategyAdding()
    {
        $articles = new Table([
                'table' => 'articles',
                'alias' => 'Articles',
                'connection' => $this->connection,
                'entityClass' => 'Cake\ORM\Entity',
            ]);

        $articles->hasMany('Comments', ['saveStrategy' => 'replace']);

        $article = $articles->newEntity([
            'title' => 'Bakeries are sky rocketing',
            'body' => 'All because of cake',
            'comments' => [
                [
                    'user_id' => 1,
                    'comment' => 'That is true!'
                ],
                [
                    'user_id' => 2,
                    'comment' => 'Of course'
                ]
            ]
        ], ['associated' => ['Comments']]);

        $article = $articles->save($article, ['associated' => ['Comments']]);
        $commentId = $article->comments[0]->id;
        $sizeComments = count($article->comments);
        $articleId = $article->id;

        $this->assertEquals($sizeComments, $articles->Comments->find('all')
                                                              ->where(['article_id' => $article->id])
                                                              ->count());
        $this->assertTrue($articles->Comments->exists(['id' => $commentId]));

        unset($article->comments[0]);
        $article->comments[] = $articles->Comments->newEntity([
            'user_id' => 1,
            'comment' => 'new comment'
        ]);

        $article->dirty('comments', true);
        $article = $articles->save($article, ['associated' => ['Comments']]);

        $this->assertEquals($sizeComments, $articles->Comments->find('all')
                                                              ->where(['article_id' => $article->id])
                                                              ->count());
        $this->assertFalse($articles->Comments->exists(['id' => $commentId]));
        $this->assertTrue($articles->Comments->exists([
            'to_char(comment)' => 'new comment',
            'article_id' => $articleId
        ]));
    }

}
