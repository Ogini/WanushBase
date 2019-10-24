<?php
/**
 * Project: WanushBaseGH
 * File: Login.php
 * Date: 24/10/2019, 12:01
 * Last Change; 24/10/2019, 11:56
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

namespace Wanush\Controllers;

use \Exception;
use PDO;

/**
 * Class Login
 * @package Wanush\Controllers
 */
class Login extends BaseController
{
    /**
     * Login controller
     */
    public function login() {
        if ($raw = $this->request->getRawBody()) {
            try {
                $json = json_decode($raw);
                $userId = $this->authenticate($json->username, $json->password);
                $response = ['success' => $userId !== false];
                if ($userId) {
                    $response['token'] = $this->jwt->createToken($userId);;
                }
                $this->returnJson($response);
            } catch (Exception $ex) {
                $this->returnJson(['success' => false, 'error' => $ex->getMessage()]);
            }
        } else {
            $this->returnJson(['success' => false]);
        }
    }

    /**
     * Authenticates a user
     * @param string $username
     * @param string $password
     * @return bool
     */
    protected function authenticate($username, $password) {
        $userQuery = $this->db->prepare('SELECT id, password FROM users where username = ?');
        $userQuery->execute([$username]);
        $user = $userQuery->fetch(PDO::FETCH_ASSOC);

        return password_verify($password, $user['password']) ? $user['id'] : false;
    }
}
