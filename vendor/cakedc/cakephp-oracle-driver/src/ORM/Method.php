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

namespace CakeDC\OracleDriver\ORM;

use CakeDC\OracleDriver\Database\OracleConnection;
use CakeDC\OracleDriver\Database\Schema\Method as Schema;
use CakeDC\OracleDriver\ORM\Exception\MissingRequestException;
use Cake\Core\App;
use Cake\Database\Type;
use Cake\Utility\Inflector;

class Method
{

    /**
     * Name of the method as it can be found in the database
     *
     * @var string
     */
    protected $_method;

    /**
     * Connection instance
     *
     * @var \Cake\Datasource\ConnectionInterface
     */
    protected $_connection;

    /**
     * The schema object containing a description of this method fields
     *
     * @var \CakeDC\OracleDriver\Database\Schema\Method
     */
    protected $_schema;

    /**
     * The request class name for the method.
     *
     * @var string
     */
    protected $_requestClass;

    /**
     * Method constructor.
     *
     * @param array $config Method config options.
     */
    public function __construct(array $config = [])
    {
        if (!empty($config['method'])) {
            $this->method($config['method']);
        }
        if (!empty($config['connection'])) {
            $this->connection($config['connection']);
        }
        if (!empty($config['schema'])) {
            $this->schema($config['schema']);
        }
        if (!empty($config['requestClass'])) {
            $this->requestClass($config['requestClass']);
        }
        $this->initialize($config);
    }

    /**
     * Returns the database method name or sets a new one
     *
     * @param string|null $method the new method name
     * @return string
     */
    public function method($method = null)
    {
        if ($method !== null) {
            $this->_method = $method;
        }
        if ($this->_method === null) {
            $method = namespaceSplit(get_class($this));
            $method = substr(end($method), 0, -6);
            $this->_method = Inflector::underscore($method);
        }
        return $this->_method;
    }

    /**
     * Returns the connection instance or sets a new one
     *
     * @param \CakeDC\OracleDriver\Database\OracleConnection|null $conn The new connection instance
     * @return \CakeDC\OracleDriver\Database\OracleConnection
     */
    public function connection(OracleConnection $conn = null)
    {
        if ($conn === null) {
            return $this->_connection;
        }

        return $this->_connection = $conn;
    }

    /**
     * Returns the schema method object describing this method's parameters.
     *
     * If an \CakeDC\OracleDriver\Database\Schema\Method is passed, it will be used for
     * this method instead of the default one.
     *
     * If an array is passed, a new \CakeDC\OracleDriver\Database\Schema\Method will be constructed out of it and used as the schema for this method.
     *
     * @param array|\CakeDC\OracleDriver\Database\Schema\Method|null $schema New schema to be used for this table
     * @return \CakeDC\OracleDriver\Database\Schema\Method
     */
    public function schema($schema = null)
    {
        if ($schema === null) {
            if ($this->_schema === null) {
                $this->_schema = $this->_initializeSchema($this->connection()
                                                               ->methodSchemaCollection()
                                                               ->describe($this->method()));
            }
            return $this->_schema;
        }

        if (is_array($schema)) {
            $schema = new Schema($this->method(), $schema);

        }

        return $this->_schema = $schema;
    }

    /**
     * Override this function in order to alter the schema used by this method.
     * This function is only called after fetching the schema out of the database.
     * If you wish to provide your own schema to this method without touching the
     * database, you can override schema() or inject the definitions though that
     * method.
     *
     * ### Example:
     *
     * ```
     * protected function _initializeSchema(\CakeDC\OracleDriver\Database\Schema\Method $method) {
     *  return $method;
     * }
     * ```
     *
     * @param \CakeDC\OracleDriver\Database\Schema\Method $method The method definition fetched from database.
     * @return \CakeDC\OracleDriver\Database\Schema\Method the altered schema
     * @api
     */
    protected function _initializeSchema(Schema $method)
    {
        return $method;
    }

    /**
     * Returns the class used to keep request parameters for this method
     *
     * @param string|null $name the name of the class to use
     * @throws \CakeDC\OracleDriver\ORM\Exception\MissingRequestException when the request class cannot be found
     * @return string
     */
    public function requestClass($name = null)
    {
        if ($name === null && !$this->_requestClass) {
            $default = '\CakeDC\OracleDriver\ORM\Request';
            $self = get_called_class();
            $parts = explode('\\', $self);

            if ($self === __CLASS__ || count($parts) < 3) {
                return $this->_requestClass = $default;
            }

            $alias = Inflector::singularize(substr(array_pop($parts), 0, -6));
            $name = implode('\\', array_slice($parts, 0, -1)) . '\Request\\' . $alias;
            if (!class_exists($name)) {
                return $this->_requestClass = $default;
            }
        }

        if ($name !== null) {
            $class = App::className($name, 'Model/Request');
            $this->_requestClass = $class;
        }

        if (!$this->_requestClass) {
            throw new MissingRequestException([$name]);
        }

        return $this->_requestClass;
    }

    /**
     * Initialize a method instance. Called after the constructor.
     *
     * You can use this method to define associations, attach behaviors
     * define validation and do any other initialization logic you need.
     *
     * ```
     *  public function initialize(array $config)
     *  {
     *      $this->belongsTo('Users');
     *      $this->belongsToMany('Tagging.Tags');
     *      $this->primaryKey('something_else');
     *  }
     * ```
     *
     * @param array $config Configuration options passed to the constructor
     * @return void
     */
    public function initialize(array $config)
    {
    }

    /**
     * Builds new request object for current method.
     *
     * @param array $data Parameters data.
     * @return Request
     */
    public function newRequest($data = null)
    {
        $class = $this->requestClass();
        $request = new $class([], [
            'repository' => $this,
        ]);
        if (is_array($data)) {
            $request->set($data);
        }
        return $request;
    }

    /**
     * Execute request. Request should be initialized.
     *
     * @param RequestInterface $request Request object instance.
     * @return mixed
     */
    public function execute(RequestInterface $request)
    {
        $query = $this->_generateSql();
        $statement = $this->connection()
                          ->prepareMethod($query);
        $request->attachTo($statement);
        $result = $statement->execute();
        $request->isNew(false);
        // @todo optional autofetch cursors
        // @todo transform output toPHP
        return $result;
    }

    /**
     * Generate query sql.
     *
     * @todo move it into builder class
     *
     * @return string
     */
    protected function _generateSql()
    {
        $query = '';
        if ($this->schema()
                 ->isFunction()
        ) {
            $query = ':result := ';
        }
        $parameters = $this->schema()
                           ->parameters();
        $query .= $this->method() . '(';
        $names = [];
        foreach ($parameters as $name) {
            if ($name === ':result') {
                continue;
            }
            $names[] = $name . ' => :' . $name;
        }
        $query .= implode(',', $names);
        $query .= ');';
        $query = 'begin ' . $query . ' end;';
        return $query;
    }

    /**
     * Returns an array that can be used to describe the internal state of this
     * object.
     *
     * @return array
     */
    public function __debugInfo()
    {
        $conn = $this->connection();
        return [
            'method' => $this->method(),
            'defaultConnection' => $this->defaultConnectionName(),
            'connectionName' => $conn ? $conn->configName() : null
        ];
    }

    /**
     * Get the default connection name.
     *
     * This method is used to get the fallback connection name if an
     * instance is created through the MethodRegistry without a connection.
     *
     * @return string
     * @see \CakeDC\OracleDriver\ORM\MethodRegistry::get()
     */
    public static function defaultConnectionName()
    {
        return 'default';
    }
}
