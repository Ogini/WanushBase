<?php
/**
 * Project: WanushBaseGH
 * File: Api.php
 * Date: 24/10/2019, 12:02
 * Last Change; 24/10/2019, 11:52
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

namespace Wanush\Controllers;

/**
 * Class Api
 * @package Wanush\Controllers
 */
class Api extends BaseController
{
    /**
     * getText entry point
     */
    public function getText() {
        $possibilities = [
            'Swinging around makes me happy.',
            'I think ABBA is the best band',
            'I love the Ramones!',
            'Civ VI is great'
        ];

        if ($this->userId) {
            $possibilities[] = 'You are logged in!!';
        }

        $text = $possibilities[mt_rand(0, count($possibilities) - 1)];
        $this->returnJson(['text' => $text]);
    }
}
