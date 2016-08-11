<?php
/**
 * Renderer.php
 * Date: 10.08.2016
 * Time: 17:30
 * PHP version 5
 *
 * @author    Michael Wanush <michael.wanush@sunzinet.com>
 * @copyright 2016 sunzinet AG
 */

namespace Wanush\Template;

/**
 * Interface Renderer
 *
 * @package Wanush\Template
 */
interface Renderer
{
    /**
     * Render Function
     *
     * @param string $template Template
     * @param array  $data     Data
     *
     * @return mixed
     */
    public function render($template, $data = []);
}
