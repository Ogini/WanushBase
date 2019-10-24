<?php
/**
 * Project: WanushBaseGH
 * File: Environment.php
 * Date: 24/10/2019, 12:05
 * Last Change; 24/10/2019, 10:07
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

namespace Wanush\Utility;

use Exception;

/**
 * Class Environment
 * @package Wanush\Utility
 */
class Environment
{
    /** @var array */
    private $configuration = [];

    /**
     * Environment constructor.
     * @param array $configuration
     */
    public function __construct(array $configuration) {
        $this->configuration = $configuration;
    }

    /**
     * @return array
     */
    public function getConfiguration(): array {
        return $this->configuration;
    }

    /**
     * @param string $var
     * @return mixed
     * @throws Exception
     */
    public function getConfigVar($var) {
        if (isset($this->configuration[$var])) {
            return $this->configuration[$var];
        }

        throw new Exception('Configuration variable ' . $var . ' does not exist');
    }
}
