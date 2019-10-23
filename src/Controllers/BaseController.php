<?php
/**
 * Created by PhpStorm.
 * User: wanushmi
 * Date: 07.12.2016
 * Time: 15:19
 */

namespace Wanush\Controllers;

use Exception;
use Http\Request;
use Http\Response;
use Wanush\Template\Renderer;
use Wanush\Database\Connection;

/**
 * Class BaseController
 * @package Wanush\Controllers
 */
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

    /**
     * Rendering Data
     * @param string $template
     */
    protected function render($template = '')
    {
        // If a template is not defined, use the class name.
        if ($template === '') {
            $classPath = explode('\\', get_class($this));
            $template = array_pop($classPath);
        }
        // If that file does not exist, use 'Index'
        if (!file_exists(PATH_BASE . 'templates/' . $template . '.twig')) {
            $template = 'Index';
        }
        $html = $this->renderer->render($template, $this->data);
        $this->response->setContent($html);
    }

    /**
     * Send JSON response
     * @param array $val
     * @param boolean $success
     */
    protected function returnJson($val, $success = true) {
        $this->response->setHeader('Content-Type', 'application/json');
        try {
            $json = array_merge(['success' => $success], $val);
            $json = json_encode($json);
        } catch (Exception $ex) {
            $json = json_encode(['success' => false, 'error' => $ex->getMessage()]);
        }
        $this->response->setContent($json);
    }
}