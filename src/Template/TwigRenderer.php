<?php
/**
 * Project: WanushBaseGH
 * File: TwigRenderer.php
 * Date: 24/10/2019, 12:05
 * Last Change; 11/09/2019, 11:33
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

namespace Wanush\Template;

use Twig_Environment;
use Twig_Error_Loader;
use Twig_Error_Runtime;
use Twig_Error_Syntax;

/**
 * Class TwigRenderer
 *
 * @package DocSearch\Template
 */
class TwigRenderer implements Renderer
{
    /**
     * Renderer
     *
     * @var Twig_Environment
     */
    protected $renderer;

    /**
     * TwigRenderer constructor.
     *
     * @param Twig_Environment $renderer Renderer
     */
    public function __construct(Twig_Environment $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Render
     *
     * @param string $template Template
     * @param array $data Data
     *
     * @return string
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    public function render($template, array $data = [])
    {
        return $this->renderer->render("$template.twig", $data);
    }
}
