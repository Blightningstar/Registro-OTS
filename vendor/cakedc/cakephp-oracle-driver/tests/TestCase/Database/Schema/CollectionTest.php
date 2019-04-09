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

use CakeDC\OracleDriver\Database\OracleConnection;
use CakeDC\OracleDriver\Database\Schema\MethodsCollection;
use CakeDC\OracleDriver\TestSuite\TestCase;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;

/**
 * Test case for Collection
 */
class CollectionTest extends TestCase
{

    public $codeFixtures = [
        'plugin.CakeDC/OracleDriver.Calc'
    ];

    /**
     * Oracle connection class instance.
     *
     * @var OracleConnection
     */
    public $connection;

    /**
     * Setup function
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->connection = ConnectionManager::get('test');
        Cache::clear(false, '_cake_method_');
        Cache::enable();
    }

    /**
     * Teardown function
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->connection);
    }

    /**
     * Test that describing non-existent tables fails.
     *
     * Tests for positive describe() calls are in each platformSchema
     * test case.
     *
     * @expectedException \Cake\Database\Exception
     * @return void
     */
    public function testDescribeIncorrectMethod()
    {
        $schema = new MethodsCollection($this->connection);
        $this->assertNull($schema->describe('CALC.SUM333'));
    }

    /**
     * Tests that schema metadata is cached
     *
     * @return void
     */
    public function testDescribeCache()
    {
        $schema = $this->connection->methodSchemaCollection();
        $method = $this->connection->methodSchemaCollection()->describe('CALC.SUM');

        Cache::delete('test_CALC_SUM', '_cake_method_');
        $this->connection->cacheMetadata(true);
        $schema = $this->connection->methodSchemaCollection();

        $result = $schema->describe('CALC.SUM');
        $this->assertEquals($method, $result);

        $result = Cache::read('test_CALC_SUM', '_cake_method_');
        $this->assertEquals($method, $result);
    }
}
