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

/**
 * Class Index
 * @package Wanush\Controllers
 */
/**
 * Class Index
 * @package Wanush\Controllers
 */
class Index
{
    /** @var Request */
    protected $request;
    /** @var Response */
    protected $response;
    /** @var Renderer */
    protected $renderer;
    /** @var array */
    protected $data = [];

    /**
     * Index constructor.
     *
     * @param Request  $request
     * @param Response $response
     * @param Renderer $renderer
     */
    public function __construct(Request $request, Response $response, Renderer $renderer)
    {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;

        $this->init();
    }

    /**
     * index Action
     */
    public function index()
    {
        $this->data['test'] = 'Testing 1, 2, 3';

        $html = $this->renderer->render('Index', $this->data);
        $this->response->setContent($html);
    }

    /**
     * Initialization
     */
    protected function init()
    {
        //
    }
}