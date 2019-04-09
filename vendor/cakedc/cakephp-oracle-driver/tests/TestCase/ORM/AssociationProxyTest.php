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
use Cake\Test\TestCase\ORM\AssociationProxyTest as CakeAssociationProxyTest;


/**
 * Tests AssociationProxy class
 *
 */
class AssociationProxyTest extends CakeAssociationProxyTest
{

    /**
     * Tests that the proxied updateAll will preserve conditions set for the association
     *
     * @return void
     */
    public function testUpdateAllFromAssociation()
    {
        $articles = TableRegistry::get('articles');
        $comments = TableRegistry::get('comments');
        $articles->hasMany('comments', ['conditions' => ['published' => 'Y']]);
        $articles->comments->updateAll(['comment' => 'changed'], ['article_id' => 1]);
        $changed = $comments
            ->find()
            ->where(['to_char(comment)' => 'changed'])
            ->count();
        $this->assertEquals(3, $changed);
    }

}
