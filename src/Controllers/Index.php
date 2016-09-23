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

use Http\Request;
use Http\Response;
use Wanush\Template\Renderer;
use Wanush\Database\Connection;

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
class Index
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
     * Index Action
     *
     * @return void
     */
    public function index()
    {
        $this->data['test'] = 'Testing 1, 2, 3';
        $this->data['debug'] = $this->db->query('SELECT * FROM users')->fetchAll(\PDO::FETCH_ASSOC);

        $html = $this->renderer->render('Index', $this->data);
        $this->response->setContent($html);
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