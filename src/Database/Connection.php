<?php
/**
 * Project: WanushBaseGH
 * File: Connection.php
 * Date: 24/10/2019, 12:01
 * Last Change; 24/10/2019, 12:01
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

namespace Wanush\Database;

use PDO;
use PDOException;

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
    public function __construct($connectionData) {
        /** @var string $host */
        /** @var string $dbname */
        /** @var string $user */
        /** @var string $pass */
        /** @var string $charset */
        extract($connectionData, EXTR_OVERWRITE);

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        parent::__construct($dsn, $user, $pass, $options);
    }

    /**
     * @param string $tableName
     * @param int $fetchStyle
     * @return array
     * @throws PDOException
     */
    public function selectAll($tableName, $fetchStyle = PDO::FETCH_ASSOC) {
        return $this->select($tableName, '*', $fetchStyle);
    }

    /**
     * @param string $tableName
     * @param mixed $fields
     * @param int $fetchStyle
     * @return array
     */
    public function select($tableName, $fields, $fetchStyle = PDO::FETCH_ASSOC) {
        if (is_array($fields)) {
            $fields = implode(', ', $fields);
        }
        return $this->query('SELECT ' . $fields . ' FROM ' . $tableName)->fetchAll($fetchStyle);
    }
}
