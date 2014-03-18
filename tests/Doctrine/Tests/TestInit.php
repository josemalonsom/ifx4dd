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

$dirTestsDbal = __DIR__ . '/../../../vendor/doctrine/dbal/tests/';

if (file_exists($dirTestsDbal)) {
  $classLoader->add('Doctrine\\Tests\\', $dirTestsDbal);
} else {
    throw new \Exception(
        'Can\'t find the tests directory of Doctrine\DBAL: ' . $dirTestsDbal
        . ': You need it to run the tests.'
    );
}

unset($classLoader);
