<?php
/**
 * Project: WanushBaseGH
 * File: Routes.php
 * Date: 24/10/2019, 12:06
 * Last Change; 23/10/2019, 17:11
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

return [
    ['GET', '[/]', ['Wanush\Controllers\Index', 'index']],
    ['GET', '/test', ['Wanush\Controllers\Index', 'index']],
    ['GET', '/api/gettext', ['Wanush\Controllers\Api', 'getText']],
    ['POST', '/api/login', ['Wanush\Controllers\Login', 'login']]
];
