<?php
/**
 * TwigRenderer.php
 * Date: 10.08.2016
 * Time: 17:30
 * PHP version 5
 *
 * @author    Michael Wanush <michael.wanush@sunzinet.com>
 * @copyright 2016 sunzinet AG
 */

namespace Wanush\Template;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

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
     * @param Environment $renderer Renderer
     */
    public function __construct(Environment $renderer)
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
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render($template, array $data = [])
    {
        return $this->renderer->render("$template.twig", $data);
    }
}
