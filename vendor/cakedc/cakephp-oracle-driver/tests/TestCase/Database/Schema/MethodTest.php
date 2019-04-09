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
use CakeDC\OracleDriver\Database\Schema\Method;
use CakeDC\OracleDriver\TestSuite\TestCase;
use Cake\Database\Type;
use Cake\Datasource\ConnectionManager;
use CakeDC\OracleDriver\ORM\MethodRegistry;


/**
 * Test case for Method
 */
class MethodTest extends TestCase
{

    public $codeFixtures = [
        'plugin.CakeDC/OracleDriver.Calc'
    ];

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        MethodRegistry::clear();
        parent::tearDown();
    }

    /**
     * Test construction with parameters
     *
     * @return void
     */
    public function testConstructWithParameters()
    {
        $parameters = [
            'a' => [
                'type' => 'float',
                'in' => true,
            ],
            'b' => [
                'type' => 'float',
                'in' => true,
            ]
        ];
        $method = new Method('CALC.SUM', $parameters);
        $this->assertEquals(['a', 'b'], $method->parameters());
    }
}
