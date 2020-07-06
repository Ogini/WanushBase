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
     */
    public function __construct(Request $request, Response $response, Renderer $renderer)
    {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;

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
}