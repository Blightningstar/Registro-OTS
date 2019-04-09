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

namespace CakeDC\OracleDriver\TestSuite;

use Cake\Core\Configure;
use Cake\TestSuite\TestCase as CakeTestCase;
use Exception;

/**
 * CakeDC Oracle TestCase class
 *
 */
abstract class TestCase extends CakeTestCase
{

    /**
     * The class responsible for managing the creation, loading and removing of fixtures
     *
     * @var \CakeDC\OracleDriver\TestSuite\Fixture\OracleFixtureManager
     */
    public $methodFixtureManager = null;

    /**
     * Chooses which fixtures to load for a given test
     *
     * Each parameter is a code module name that corresponds to a fixture, i.e. package, procedure or function name.
     *
     * @return void
     * @throws \Exception when no fixture manager is available.
     */
    public function loadMethodFixtures()
    {
        if (empty($this->methodFixtureManager)) {
            throw new Exception('No fixture manager to load the test fixture');
        }
        $args = func_get_args();
        foreach ($args as $class) {
            $this->methodFixtureManager->loadSingle($class, null, $this->dropTables);
        }
    }
}
