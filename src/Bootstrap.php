<?php
/**
 * Bootstrap.php
 * Date: 10.08.2016
 * Time: 16:31
 * PHP version 5
 *
 * @author    Michael Wanush <michael.wanush@sunzinet.com>
 * @copyright 2016 sunzinet AG
 */

namespace Wanush;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Http\HttpRequest;
use Http\HttpResponse;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require __DIR__ . '/../vendor/autoload.php';
$configuration = include __DIR__ . '/Config.php';

error_reporting($configuration['error_reporting']);

$environment = $configuration['environment'];

/**
 * Register the error handler
 */
$whoops = new Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new PrettyPageHandler);
} else {
    $whoops->pushHandler(function ($e) {
        echo 'Friendly error page and send an email to the developer';
    });
}
$whoops->register();

$injector = include __DIR__ . '/Dependencies.php';

/** @var HttpRequest $request */
$request = $injector->make('Http\HttpRequest');
/** @var HttpResponse $response */
$response = $injector->make('Http\HttpResponse');

$routeDefinitionCallback = function (RouteCollector $r) {
    /** @var array $routes */
    $routes = include __DIR__ . '/Routes.php';
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());
switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        break;
    case Dispatcher::FOUND:
        list($className, $method) = $routeInfo[1];
        $vars = $routeInfo[2];

        $class = $injector->make($className);
        $class->$method($vars);
        break;
}

foreach ($response->getHeaders() as $header) {
    header($header, false);
}

echo $response->getContent();
