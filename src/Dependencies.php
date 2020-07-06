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

use Auryn\Injector;

$injector = new Injector;

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

$injector->alias('Wanush\Template\Renderer', 'Wanush\Template\TwigRenderer');

$injector->delegate(
    'Twig\Environment',
    function () use ($injector) {
        $loader = new Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/templates');
        $twig = new Twig\Environment($loader, array('debug' => true));
        $twig->addExtension(new Twig\Extension\DebugExtension());

        $twig->addFilter( new Twig\TwigFilter('cast_to_array', function ($stdClassObject) {
            $response = array();
            foreach ($stdClassObject as $key => $value) {
                $response[$key] = $value;
            }
            return $response;
        }));

        return $twig;
    }
);

$injector->defineParam('configuration', $configuration);

return $injector;
