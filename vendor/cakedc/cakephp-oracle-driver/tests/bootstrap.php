<?php

$findRoot = function () {
    $root = dirname(__DIR__);
    if (is_dir($root . '/vendor/cakephp/cakephp')) {
        return $root;
    }

    $root = dirname(dirname(__DIR__));
    if (is_dir($root . '/vendor/cakephp/cakephp')) {
        return $root;
    }

    $root = dirname(dirname(dirname(__DIR__)));
    if (is_dir($root . '/vendor/cakephp/cakephp')) {
        return $root;
    }
};

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

function _define($name, $value)
{
    if (!defined($name)) {
        define($name, $value);
    }
}

_define('ROOT', $findRoot());
_define('APP_DIR', 'App');
_define('WEBROOT_DIR', 'webroot');
_define('APP', ROOT . '/tests/App/');
_define('CONFIG', ROOT . '/tests/Config/');
_define('WWW_ROOT', ROOT . DS . WEBROOT_DIR . DS);
_define('TESTS', ROOT . DS . 'tests' . DS);
_define('TMP', ROOT . DS . 'tmp' . DS);
_define('LOGS', TMP . 'logs' . DS);
_define('CACHE', TMP . 'cache' . DS);
_define('CAKE_CORE_INCLUDE_PATH', ROOT . '/vendor/cakephp/cakephp');
_define('CORE_PATH', CAKE_CORE_INCLUDE_PATH . DS);
_define('CAKE', CORE_PATH . 'src' . DS);

//require_once ROOT . '/vendor/cakephp/cakephp/src/basics.php';
require_once ROOT . '/vendor/autoload.php';

Cake\Core\Configure::write('App', ['namespace' => 'CakeDC\\OracleDriver\\Test\\App']);
Cake\Core\Configure::write('debug', true);

$TMP = new \Cake\Filesystem\Folder(TMP);
$TMP->create(TMP . 'cache/models', 0777);
$TMP->create(TMP . 'cache/persistent', 0777);
$TMP->create(TMP . 'cache/views', 0777);

$cache = [
    'default' => [
        'engine' => 'File',
    ],
    '_cake_core_' => [
        'className' => 'File',
        'prefix' => 'oracle_driver_cake_core_',
        'path' => CACHE . 'persistent/',
        'serialize' => true,
        'duration' => '+10 seconds',
    ],
    '_cake_model_' => [
        'className' => 'File',
        'prefix' => 'oracle_driver_cake_model_',
        'path' => CACHE . 'models/',
        'serialize' => 'File',
        'duration' => '+10 seconds',
    ],
    '_cake_method_' => [
        'className' => 'File',
        'prefix' => 'oracle_driver_cake_method_',
        'path' => CACHE . 'models/',
        'serialize' => 'File',
        'duration' => '+10 seconds',
    ],
];

Cake\Cache\Cache::config($cache);
Cake\Core\Configure::write('Session', [
    'defaults' => 'php'
]);

Cake\Core\Plugin::load('CakeDC\\OracleDriver', [
    'path' => ROOT . DS,
    'autoload' => true
]);

Cake\Routing\DispatcherFactory::add('Routing');
Cake\Routing\DispatcherFactory::add('ControllerFactory');

// Ensure default test connection is defined
if (!getenv('db_dsn')) {
    putenv('db_dsn=sqlite:///:memory:');
}

Cake\Datasource\ConnectionManager::config('test', [
    'url' => getenv('db_dsn'),
    'timezone' => 'UTC'
]);
