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

namespace CakeDC\OracleDriver\Test\TestCase\Database\Schema;

use Cake\Test\TestCase\Database\Schema\TableTest as CakeTableTest;


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
        'core.categories',
        'core.products',
        'core.orders',
    ];

}
