<?php
/**
 * Created by PhpStorm.
 * User: wanushmi
 * Date: 24.06.2016
 * Time: 13:31
 */

namespace Wanush\Template;

interface Renderer
{
    public function render($template, $data = []);
}
