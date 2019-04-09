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

namespace CakeDC\OracleDriver\Panel;

use CakeDC\OracleDriver\Database\OracleConnection;
use CakeDC\OracleDriver\ORM\MethodRegistry;
use CakeDC\OracleDriver\Database\Log\DebugMethodLog;
use Cake\Datasource\ConnectionManager;
use DebugKit\DebugPanel;

/**
 * Provides debug information on the Method logs and provides links to an ajax explain interface.
 *
 */
class MethodLogPanel extends DebugPanel
{


    public $plugin = 'OracleDriver';

    /**
     * Loggers connected
     *
     * @var array
     */
    protected $_loggers = [];

    /**
     * Initialize hook - configures logger.
     *
     * This will unfortunately build all the connections, but they
     * won't connect until used.
     *
     * @return array
     */
    public function initialize()
    {
        $configs = ConnectionManager::configured();
        foreach ($configs as $name) {
            $connection = ConnectionManager::get($name);
            if (!$connection instanceof OracleConnection) {
                continue;
            }
            if ($connection->configName() === 'debug_kit') {
                continue;
            }
            $logger = null;
            if ($connection->logQueries()) {
                $logger = $connection->methodLogger();
            }

            if ($logger instanceof DebugMethodLog) {
                continue;
            }
            $logger = new DebugMethodLog($logger, $name);

            $connection->logQueries(true);
            $connection->methodLogger($logger);
            $this->_loggers[] = $logger;
        }
    }

    /**
     * Get the data this panel wants to store.
     *
     * @return array
     */
    public function data()
    {
        return [
            'methods' => array_map(function ($method) {
                return $method->method();
            }, MethodRegistry::genericInstances()),
            'loggers' => $this->_loggers,
        ];
    }

    /**
     * Get summary data from the methods run.
     *
     * @return string
     */
    public function summary()
    {
        $count = $time = 0;
        foreach ($this->_loggers as $logger) {
            $count += count($logger->queries());
            $time += $logger->totalTime();
        }
        if (!$count) {
            return '0';
        }
        return "$count / $time ms";
    }
}
