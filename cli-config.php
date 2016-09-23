<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once __DIR__ . '/src/Bootstrap.php';

return ConsoleRunner::createHelperSet($entityManager);