<?php

namespace CakeDC\OracleDriver\Core;

/**
 * Singleton trait.
 */
trait Singleton
{

    /**
     * Object instance.
     *
     * @var mixed
     */
    protected static $_instance;

    /**
     * Returns object instance.
     *
     * @return object instance.
     */
    final public static function getInstance()
    {
        return isset(static::$_instance) ? static::$_instance : static::$_instance = new static;
    }

    /**
     * Singleton constructor.
     */
    final private function __construct()
    {
        $this->init();
    }

    /**
     * Default initialization instance.
     *
     * @return void
     */
    protected function init()
    {
    }

    final private function __wakeup()
    {
    }

    final private function __clone()
    {
    }
}