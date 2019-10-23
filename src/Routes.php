<?php
/**
 * Routes.php
 * Date: 10.08.2016
 * Time: 16:41
 * PHP version 5
 *
 * @author    Michael Wanush <michael.wanush@sunzinet.com>
 * @copyright 2016 sunzinet AG
 */

return [
    ['GET', '[/]', ['Wanush\Controllers\Index', 'index']],
    ['GET', '/test', ['Wanush\Controllers\Index', 'index']],
    ['GET', '/api/gettext', ['Wanush\Controllers\Api', 'getText']]
];
