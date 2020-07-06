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

use Wanush\Models\User;

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
        $this->data['name'] = 'Testing 1, 2, 3';

        $this->data['table'] = [
            'success' => true,
            'data' => User::query()->get()->toArray()
        ];

        $this->render();
    }
}
