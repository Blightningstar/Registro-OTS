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

namespace CakeDC\OracleDriver\Database\Schema;

use Cake\Database\Exception;
use Cake\Datasource\ConnectionInterface;
use PDOException;

/**
 * Represents a database methods collection
 *
 * Used to access information about the tables,
 * and other data in a database.
 */
class MethodsCollection
{

    /**
     * Connection object
     *
     * @var \Cake\Datasource\ConnectionInterface
     */
    protected $_connection;

    /**
     * Schema dialect instance.
     *
     * @var \Cake\Database\Schema\BaseSchema
     */
    protected $_dialect;

    /**
     * Constructor.
     *
     * @param \Cake\Datasource\ConnectionInterface $connection The connection instance.
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->_connection = $connection;
        $this->_dialect = $connection->driver()->schemaDialect();
    }

    /**
     * Get the list of tables available in the current connection.
     *
     * @return array The list of tables in the connected database/schema.
     */
    public function listMethods()
    {
        // @todo fix this method to return only high level data
        list($sql, $params) = $this->_dialect->listMethodsSql($this->_connection->config());
        $result = [];
        $statement = $this->_connection->execute($sql, $params);
        while ($row = $statement->fetch()) {
            $result[] = $row[0];
        }
        $statement->closeCursor();
        return $result;
    }

    /**
     * Get the list of tables available in the current connection.
     *
     * @param $name
     * @return array The list of tables in the connected database/schema.
     */
    public function getMethod($name)
    {
        $config = $this->_connection->config();
        $config['objectName'] = $name;
        list($sql, $params) = $this->_dialect->listMethodsSql($config);
        $result = [];
        $statement = $this->_connection->execute($sql, $params);
        while ($row = $statement->fetch()) {
            $result[] = $row[0];
        }
        $statement->closeCursor();
        return $result;
    }

    /**
     * Get the column metadata for a table.
     *
     * Caching will be applied if `cacheMetadata` key is present in the Connection
     * configuration options. Defaults to _cake_method_ when true.
     *
     * ### Options
     *
     * - `forceRefresh` - Set to true to force rebuilding the cached metadata.
     *   Defaults to false.
     *
     * @param string $name The name of the table to describe.
     * @param array $options The options to use, see above.
     * @return \CakeDC\OracleDriver\Database\Schema\Method Object with method metadata.
     * @throws \Cake\Database\Exception when table cannot be described.
     */
    public function describe($name, array $options = [])
    {
        $config = $this->_connection->config();
        $methods = $this->getMethod($name);
        if (empty($methods)) {
            throw new Exception(sprintf('Cannot describe %s. Method not found.', $name));
        }
        $method = new Method($name);

        $this->_reflect($method, $name, $config);
        return $method;
    }

    /**
     * Helper method for running each step of the reflection process.
     *
     * @param \CakeDC\OracleDriver\Database\Schema\Method $method Object with method metadata.
     * @param string $name The table name.
     * @param array $config The config data.
     * @return void
     * @throws \Cake\Database\Exception on query failure.
     */
    protected function _reflect($method, $name, $config)
    {
        list($sql, $params) = $this->_dialect->describeParametersSql($name, $config);
        if (empty($sql)) {
            return;
        }
        try {
            $statement = $this->_connection->execute($sql, $params);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage(), 500, $e);
        }
        foreach ($statement->fetchAll('assoc') as $row) {
            $this->_dialect->convertParametersDescription($method, $row);
        }
        $statement->closeCursor();
    }
}
