#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Wanush\Commands\TestCommand;

$application = new Application();

$application->add(new TestCommand());

try {
    $application->run();
} catch (Exception $e) {
}
