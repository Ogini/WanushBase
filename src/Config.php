<?php
/**
 * Config.php
 * Date: 10.08.2016
 * Time: 16:32
 * PHP version 5
 *
 * @author    Michael Wanush <michael.wanush@sunzinet.com>
 * @copyright 2016 sunzinet AG
 */

return [
    'error_reporting' => E_ALL,
    'environment' => 'development',
    'database' => [
        'driver' => 'pdo_mysql',
        'host'   => 'localhost',
        'user'   => 'mwanush',
        'pass'   => 'Ram0nes',
        'dbname' => 'mike',
        'charset'=> 'utf8'
    ]
];
