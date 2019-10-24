<?php
/**
 * Project: WanushBaseGH
 * File: Jwt.php
 * Date: 24/10/2019, 12:05
 * Last Change; 24/10/2019, 11:41
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

namespace Wanush\Utility;

use Exception;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

/**
 * Class Jwt
 * @package Wanush\Utility
 */
class Jwt
{
    /**
     * @var Environment
     */
    protected $environment;

    /**
     * Time of token life
     */
    const TOKEN_TIME_LIMIT = 3600;

    /**
     * Within X seconds of expiration
     */
    const TOKEN_REFRESH_DIFF = 600;

    /**
     * JWT Identifier
     */
    const JWT_IDENTIFIER = 'asdf8asd6$QFS34qfasd';

    /**
     * Jwt constructor.
     * @param Environment $environment
     */
    public function __construct(Environment $environment) {
        $this->environment = $environment;
    }

    /**
     * Check for JWT header or JSON
     * @param string $body
     * @param bool $newToken
     * @return int
     * @throws Exception
     */
    public function checkJwt($body, &$newToken) {
        $userId = 0;
        if (isset($_SERVER['HTTP_AUTHORIZATION']) && preg_match('/Bearer (.*)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
            if ($token = trim($matches[1])) {
                $userId = $this->parseToken($token, $newToken);
            }
        }
        if (!$userId && $body) {
            $json = json_decode($body);
            if (isset($json->jwt)) {
                $userId = $this->parseToken($json->jwt, $newToken);
            }
        }

        return $userId;
    }

    /**
     * @param $userId
     * @return string
     * @throws Exception
     */
    public function createToken($userId) {
        $time = time();
        $token = (new Builder())->issuedBy($this->environment->getConfigVar('url'))
            ->permittedFor($this->environment->getConfigVar('url'))
            ->identifiedBy(self::JWT_IDENTIFIER, false)
            ->issuedAt($time)
            ->canOnlyBeUsedAfter($time)
            ->expiresAt($time + self::TOKEN_TIME_LIMIT)
            ->withClaim('uid', $userId)
            ->getToken();

        return (string)$token;
    }

    /**
     * @param string $token
     * @param $newToken
     * @return integer
     * @throws Exception
     */
    private function parseToken($token, &$newToken) {
        $token = (new Parser())->parse((string)$token);

        $data = new ValidationData();
        $data->setIssuer($this->environment->getConfigVar('url'));
        $data->setAudience($this->environment->getConfigVar('url'));
        $data->setId('abba123agnetha456');

        if ($token->validate($data)) {
            $uid = (int)$token->getClaim('uid');
            $exp = (int)$token->getClaim('exp');
            if ($exp - time() < self::TOKEN_REFRESH_DIFF) {
                $newToken = true;
            }
            return $uid;
        }

        return 0;
    }
}
