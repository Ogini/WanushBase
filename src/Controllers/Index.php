<?php
/**
 * Project: WanushBaseGH
 * File: Index.php
 * Date: 24/10/2019, 12:01
 * Last Change; 24/10/2019, 11:56
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

namespace Wanush\Controllers;


use Exception;
use PDOException;

/**
 * Class Index
 *
 * @package Wanush\Controllers
 */
class Index extends BaseController
{
    /**
     * Index Action
     *
     * @return void
     * @throws Exception
     */
    public function index() {
        $this->data['name'] = 'Testing 1, 2, 3';
        try {
            $this->data['table'] = [
                'success' => true,
                'data' => $this->db->selectAll('users')
            ];
        } catch (PDOException $e) {
            $this->data['table'] = [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }

        $this->render();
    }
}
