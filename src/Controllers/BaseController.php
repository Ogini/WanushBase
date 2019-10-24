<?php
/**
 * Project: WanushBaseGH
 * File: BaseController.php
 * Date: 24/10/2019, 12:01
 * Last Change; 24/10/2019, 11:56
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

namespace Wanush\Controllers;

use Exception;
use Http\Request;
use Http\Response;
use Wanush\Database\Connection;
use Wanush\Template\Renderer;
use Wanush\Utility\Environment;
use Wanush\Utility\Jwt;

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
     * Configuration environment
     *
     * @var Environment
     */
    protected $environment;
    /**
     * Logged in user ID
     *
     * @var integer
     */
    protected $userId = 0;
    /**
     * Jwt
     *
     * @var Jwt
     */
    protected $jwt;
    /**
     * Should we send a new token
     *
     * @var bool
     */
    protected $sendNewJwtToken = false;


    /**
     * Index constructor.
     *
     * @param Request $request Request
     * @param Response $response Response
     * @param Renderer $renderer Renderer
     * @param Connection $connection Connection
     * @param Environment $environment Environment
     * @param Jwt $jwt Jwt
     * @throws Exception
     */
    public function __construct(Request $request, Response $response, Renderer $renderer, Connection $connection, Environment $environment, Jwt $jwt) {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
        $this->db = $connection;
        $this->environment = $environment;
        $this->jwt = $jwt;
        $this->userId = $this->jwt->checkJwt($this->request->getRawBody(), $this->sendNewJwtToken);

        $this->init();
    }

    /**
     * Initialization
     *
     * @return void
     */
    protected function init() {
        //
    }

    /**
     * Rendering Data
     * @param string $template
     * @throws Exception
     */
    protected function render($template = '') {
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
        if ($this->sendNewJwtToken && $this->userId) {
            $this->response->setHeader('AuthToken', $this->jwt->createToken($this->userId));
        }
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
            if ($this->sendNewJwtToken && $this->userId) {
                $json['token'] = $this->jwt->createToken($this->userId);
            }
            $json = json_encode($json);
        } catch (Exception $ex) {
            $json = json_encode(['success' => false, 'error' => $ex->getMessage()]);
        }
        $this->response->setContent($json);
    }
}
