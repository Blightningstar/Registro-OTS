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

namespace CakeDC\OracleDriver\Database\OCI8;

use Cake\Core\InstanceConfigTrait;
use PDO;

/**
 * OCI8 implementation of the Connection interface.
 */
class OCI8Connection extends PDO
{
    use InstanceConfigTrait;

    /**
     * Whether currently in a transaction
     *
     * @var bool
     */
    protected $_inTransaction = false;

    /**
     * Database connection.
     *
     * @var resource
     */
    protected $dbh;

    /**
     * @var integer
     */
    protected $executeMode = OCI_COMMIT_ON_SUCCESS;

    protected $_defaultConfig = [];

    /**
     * Creates a Connection to an Oracle Database using oci8 extension.
     *
     * @param string $dsn Oracle connection string in oci_connect format.
     * @param string $username Oracle username.
     * @param string $password Oracle user's password.
     * @param array $options Additional connection settings.
     *
     * @throws OCI8Exception
     */
    public function __construct($dsn, $username, $password, $options)
    {
        $persistent = !empty($options['persistent']);
        $charset = !empty($options['charset']) ? $options['charset'] : null;
        $sessionMode = !empty($options['sessionMode']) ? $options['sessionMode'] : null;

        if ($persistent) {
            $this->dbh = @oci_pconnect($username, $password, $dsn, $charset, $sessionMode);
        } else {
            $this->dbh = @oci_connect($username, $password, $dsn, $charset, $sessionMode);
        }

        if (!$this->dbh) {
            throw OCI8Exception::fromErrorInfo(oci_error());
        }

        $this->config($options);
    }

    /**
     * Returns database connection.
     *
     * @return resource
     */
    public function dbh()
    {
        return $this->dbh;
    }

    /**
     * Returns oracle version.
     *
     * @throws \UnexpectedValueException if the version string returned by the database server does not parsed
     * @return int Version number
     */
    public function getServerVersion()
    {
        $versionData = oci_server_version($this->dbh);
        if (!preg_match('/\s+(\d+\.\d+\.\d+\.\d+\.\d+)\s+/', $versionData, $version)) {
            throw new \UnexpectedValueException(__('Unexpected database version string "{0}" that not parsed.', $versionData));
        }

        return $version[1];
    }

    /**
     * {@inheritdoc}
     */
    public function prepare($statement, $options = null)
    {
        return new OCI8Statement($this->dbh, $statement, $this);
    }

    /**
     * {@inheritdoc}
     */
    public function query($statement, $mode = PDO::ATTR_DEFAULT_FETCH_MODE, $arg3 = null)
    {
        $args = func_get_args();
        $sql = $args[0];
        $stmt = $this->prepare($sql);
        $stmt->execute();

        return $stmt;
    }

    /**
     * {@inheritdoc}
     */
    public function quote($string, $type = \PDO::PARAM_STR)
    {
        if (is_int($string) || is_float($string)) {
            return $string;
        }
        $string = str_replace("'", "''", $string);

        return "'" . addcslashes($string, "\000\n\r\\\032") . "'";
    }

    /**
     * {@inheritdoc}
     */
    public function exec($statement)
    {
        $stmt = $this->prepare($statement);
        $stmt->execute();

        return $stmt->rowCount();
    }

    /**
     * Returns the current execution mode.
     *
     * @return integer
     */
    public function getExecuteMode()
    {
        return $this->executeMode;
    }

    /**
     * Returns true if the current process is in a transaction
     *
     * @deprecated Use inTransaction() instead
     * @return bool
     */
    public function isTransaction()
    {
        return $this->inTransaction();
    }

    /**
     * {@inheritdoc}
     */
    public function inTransaction()
    {
        return $this->executeMode == OCI_NO_AUTO_COMMIT;
    }

    /**
     * {@inheritdoc}
     */
    public function beginTransaction()
    {
        $this->executeMode = OCI_NO_AUTO_COMMIT;

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function commit()
    {
        if (!oci_commit($this->dbh)) {
            throw OCI8Exception::fromErrorInfo($this->errorInfo());
        }
        $this->executeMode = OCI_COMMIT_ON_SUCCESS;

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rollBack()
    {
        if (!oci_rollback($this->dbh)) {
            throw OCI8Exception::fromErrorInfo($this->errorInfo());
        }
        $this->executeMode = OCI_COMMIT_ON_SUCCESS;

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function errorCode()
    {
        $error = oci_error($this->dbh);
        if ($error !== false) {
            $error = $error['code'];
        } else {
            return '00000';
        }

        return $error;
    }

    /**
     * {@inheritdoc}
     */
    public function errorInfo()
    {
        return oci_error($this->dbh);
    }
}
