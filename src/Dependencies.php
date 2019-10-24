<?php
/**
 * Project: WanushBaseGH
 * File: Dependencies.php
 * Date: 24/10/2019, 12:07
 * Last Change; 24/10/2019, 10:03
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

use Auryn\Injector;

$injector = new Injector;

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define(
    'Http\HttpRequest',
    [
        $_GET,
        $_POST,
        $_COOKIE,
        $_FILES,
        $_SERVER,
        file_get_contents('php://input')
    ]
);

$injector->share('Wanush\Utility\Environment');
$injector->define('Wanush\Utility\Environment', [$configuration]);

$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');

$injector->share('Wanush\Database\Connection');
$injector->define(
    'Wanush\Database\Connection',
    [
        ':connectionData' => $configuration['database']
    ]
);

$injector->alias('Wanush\Template\Renderer', 'Wanush\Template\TwigRenderer');

$injector->delegate(
    'Twig_Environment',
    function () use ($injector) {
        $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/templates');
        $twig = new Twig_Environment($loader, array('debug' => true));
        $twig->addExtension(new Twig_Extension_Debug());
        return $twig;
    }
);

$injector->defineParam('configuration', $configuration);

return $injector;
