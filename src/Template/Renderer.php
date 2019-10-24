<?php
/**
 * Project: WanushBaseGH
 * File: Renderer.php
 * Date: 24/10/2019, 12:04
 * Last Change; 11/09/2019, 11:33
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
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
    public function render($template, array $data = []);
}
