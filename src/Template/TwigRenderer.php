<?php
/**
 * Created by PhpStorm.
 * User: wanushmi
 * Date: 24.06.2016
 * Time: 13:44
 */

namespace Wanush\Template;

use Twig_Environment;

/**
 * Class TwigRenderer
 * @package DocSearch\Template
 */
class TwigRenderer implements Renderer
{
    private $renderer;

    /**
     * TwigRenderer constructor.
     * @param Twig_Environment $renderer
     */
    public function __construct(Twig_Environment $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param string $template
     * @param array $data
     * @return string
     */
    public function render($template, $data = [])
    {
        return $this->renderer->render("$template.twig", $data);
    }
}
