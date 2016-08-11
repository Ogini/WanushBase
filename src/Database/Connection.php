<?php
/**
 * Connection.php
 * Date: 10.08.2016
 * Time: 17:30
 * PHP version 5
 *
 * @author    Michael Wanush <michael.wanush@sunzinet.com>
 * @copyright 2016 sunzinet AG
 */

namespace Wanush\Database;

use \PDO;

/**
 * Class Connection
 *
 * @package Wanush\Database
 */
class Connection extends PDO
{
    /**
     * Connection constructor.
     *
     * @param array $connectionData Connection Data Array
     */
    public function __construct($connectionData)
    {
        $configuration = array_values($connectionData);
        list($host, $user, $pass, $db) = $configuration;
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        parent::__construct($dsn, $user, $pass, $options);
    }
}