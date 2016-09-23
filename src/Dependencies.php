<?php
/**
 * Dependencies.php
 * Date: 10.08.2016
 * Time: 16:38
 * PHP version 5
 *
 * @author    Michael Wanush <michael.wanush@sunzinet.com>
 * @copyright 2016 sunzinet AG
 */

$injector = new \Auryn\Injector;

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define(
    'Http\HttpRequest',
    [
        ':get' => $_GET,
        ':post' => $_POST,
        ':cookies' => $_COOKIE,
        ':files' => $_FILES,
        ':server' => $_SERVER,
    ]
);

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
$injector->defineParam('config', $config);
$injector->defineParam('entityManager', $entityManager);

return $injector;
