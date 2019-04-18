<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;


/*Evita que los nombres exactos de las tablas aparezcan en la URL
 El primer router connect se encarga de reemplazar el nombre exacto de la tabla por un nombre normal para cada CRUD
 El segundo router connect se encarga de reemplazar el nombore exacto de la tabla por un nombre normal en los indexs
Agregado por Esteban*/

Router::connect('curso/add', array('controller' => 'ProCurso', 'action' => 'add' ));
Router::connect('curso/view/*', array('controller' => 'ProCurso', 'action' => 'view'));
Router::connect('curso/edit/*', array('controller' => 'ProCurso', 'action' => 'edit'));
Router::connect('curso/delete/*', array('controller' => 'ProCurso', 'action' => 'delete'));
Router::connect('curso', array('controller' => 'ProCurso'));


Router::connect('usuario/add', array('controller' => 'SegUsuario', 'action' => 'add' ));
Router::connect('usuario/view/*', array('controller' => 'SegUsuario', 'action' => 'view'));
Router::connect('usuario/edit/*', array('controller' => 'SegUsuario', 'action' => 'edit'));
Router::connect('usuario/password-change', array('controller' => 'SegUsuario', 'action' => 'PasswordChange'));
Router::connect('usuario/profile-edit', array('controller' => 'SegUsuario', 'action' => 'profileEdit'));
Router::connect('usuario/profile-view', array('controller' => 'SegUsuario', 'action' => 'profileView'));
Router::connect('usuario/delete/*', array('controller' => 'SegUsuario', 'action' => 'delete'));
Router::connect('usuario', array('controller' => 'SegUsuario'));


Router::connect('programa/add', array('controller' => 'ProPrograma', 'action' => 'add' ));
Router::connect('programa/view/*', array('controller' => 'ProPrograma', 'action' => 'view'));
Router::connect('programa/edit/*', array('controller' => 'ProPrograma', 'action' => 'edit'));
Router::connect('programa/delete/*', array('controller' => 'ProPrograma', 'action' => 'delete'));
Router::connect('programa', array('controller' => 'ProPrograma'));

Router::connect('pregunta/add', array('controller' => 'SolPregunta', 'action' => 'add' ));
Router::connect('pregunta/view/*', array('controller' => 'SolPregunta', 'action' => 'view'));
Router::connect('pregunta/edit/*', array('controller' => 'SolPregunta', 'action' => 'edit'));
Router::connect('pregunta/delete/*', array('controller' => 'SolPregunta', 'action' => 'delete'));
Router::connect('pregunta', array('controller' => 'SolPregunta'));

//Termina Esteban

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));

    /**
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered via `Application::routes()` with `registerMiddleware()`
     */
    $routes->applyMiddleware('csrf');

    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *
     * ```
     * $routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);
     * $routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);
     * ```
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * Router::scope('/api', function (RouteBuilder $routes) {
 *     // No $routes->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */
