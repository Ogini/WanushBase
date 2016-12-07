<?php
/**
 * Created by PhpStorm.
 * User: wanushmi
 * Date: 07.12.2016
 * Time: 15:19
 */

namespace Wanush\Controllers;

use Http\Request;
use Http\Response;
use Wanush\Template\Renderer;
use Wanush\Database\Connection;

class BaseController
{
    /**
     * Request
     *
     * @var Request
     */
    protected $request;
    /**
     * Response
     *
     * @var Response
     */
    protected $response;
    /**
     * Renderer
     *
     * @var Renderer
     */
    protected $renderer;
    /**
     * Database Connection
     *
     * @var Connection
     */
    protected $db;
    /**
     * Display Data
     *
     * @var array
     */
    protected $data = [];

    /**
     * Index constructor.
     *
     * @param Request    $request    Request
     * @param Response   $response   Response
     * @param Renderer   $renderer   Renderer
     * @param Connection $connection Connection
     */
    public function __construct(Request $request, Response $response, Renderer $renderer, Connection $connection)
    {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
        $this->db = $connection;

        $this->init();
    }

    /**
     * Initialization
     *
     * @return void
     */
    protected function init()
    {
        //
    }
}