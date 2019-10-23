<?php


namespace Wanush\Controllers;

/**
 * Class Api
 * @package Wanush\Controllers
 */
class Api extends BaseController {
    public function getText() {
        $possibilities = [
            'Swinging around makes me happy.',
            'I think ABBA is the best band',
            'I love the Ramones!',
            'Civ VI is great'
        ];

        $text = $possibilities[mt_rand(0, count($possibilities) - 1)];
        $this->returnJson(['text' => $text]);
    }
}