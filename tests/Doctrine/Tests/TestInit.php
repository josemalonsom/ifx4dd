<?php
/*
 * This file bootstraps the test environment.
 *
 * First it adds the Informix Platform path to the autoloader and then the
 * path of the DBAL tests thereby the Informix Platform classes are loaded
 * in first place.
 */
namespace Doctrine\Tests;

error_reporting(E_ALL | E_STRICT);

if (file_exists(__DIR__ . '/../../../vendor/autoload.php')) {
    // dependencies were installed via composer - this is the main project
    $classLoader = require __DIR__ . '/../../../vendor/autoload.php';
} elseif (file_exists(__DIR__ . '/../../../../../autoload.php')) {
    // installed as a dependency in `vendor`
    $classLoader = require __DIR__ . '/../../../../../autoload.php';
} else {
    throw new \Exception('Can\'t find autoload.php. Did you install dependencies via composer?');
}

/* @var $classLoader \Composer\Autoload\ClassLoader */
$classLoader->add('Doctrine\\Tests\\', __DIR__ . '/../../');
unset($classLoader);

$testInitDbal = __DIR__ . '/../../../vendor/doctrine/dbal/tests/Doctrine/Tests/TestInit.php';

if (file_exists($testInitDbal)) {
  require_once $testInitDbal;
} else {
    throw new \Exception(
        'Can\'t find the TestInit.php of the Doctrine\DBAL tests: ' . $testInitDbal
        . ': You need it to run the tests.'
    );
}

