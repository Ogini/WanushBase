<?php
/**
 * Index.php
 * Date: 10.08.2016
 * Time: 16:44
 * PHP version 5
 *
 * @author    Michael Wanush <michael.wanush@sunzinet.com>
 * @copyright 2016 sunzinet AG
 */

namespace Wanush\Controllers;


/**
 * Class Index
 *
 * @package Wanush\Controllers
 */
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
     */
    public function index()
    {
        $this->data['test'] = 'Testing 1, 2, 3';
        try {
            $this->data['debug'] = $this->db->query('SELECT * FROM users')->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            $this->data['debug'] = array();
        }

        $html = $this->renderer->render('Index', $this->data);
        $this->response->setContent($html);
    }


}