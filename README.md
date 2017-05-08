
# Informix Platform for Doctrine DBAL

The *Informix Platform for Doctrine DBAL*  gives support for Informix to
[Doctrine\DBAL](http://www.doctrine-project.org/projects/dbal.html) the database
abstraction layer of the [Doctrine project](http://www.doctrine-project.org).

[![Build Status](http://vps195060.ovh.net/job/ifx4dd-1.0/badge/icon)](http://vps195060.ovh.net/job/ifx4dd-1.0)

## DBAL versions supported

This version works with DBAL 2.5.


## Informix versions supported

It is tested on Informix Dynamic Server versions 11.50, 11.70 and 12.10.


## INSTALL

If you don't already have the PDO\_INFORMIX extension for PHP you need install it
(see [PDO\_INFORMIX](http://www.php.net/manual/en/ref.pdo-informix.php)), make
sure that the extension works correctly before continue, you can do a quick
connection test to your Informix server using the next example

```php
    <?php

    $dsn = 'informix:'
        . 'host=hosttest1;'
        . 'server=test1tcp;'
        . 'database=test_database;'
        . 'protocol=onsoctcp;'
        . 'service=50000;';

    $user = 'your_user';
    $password = 'your_password';

    $con = new PDO($dsn, $user, $password);

    if ($con) {
      echo "The connection was successfully established\n";
    }
```

You also will need [composer](https://getcomposer.org) in order to install all
the dependencies, if you don't have it install it first.

### Install from the repository

Download the code of the *Informix Platform for Doctrine DBAL* or clone it with
git ```git clone https://github.com/josemalonsom/Ifx4dd.git```. Move to the
directory where you have the sources and install dependencies with composer

```bash
    $ cd Ifx4dd/
    $ composer install
```

it will install Doctrine\DBAL under the vendor directory and will create an
autoloader class that you can find in the vendor/autoload.php file. The
autoloader will add the Informix Platform directories in first place so that
you can use the Informix Platform specific versions of some of the DBAL classes.

### Install with composer

Simply execute:

```bash
    composer require "josemalonsom/ifx4dd:dev-master"
```

it will install the libraries under the `vendor` directory.

## Getting a connection with Informix

If you don't have experience with DBAL please read first its documentation
[Doctrine\DBAL documentation](http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest)

To create a connection you can use the modified version of the DriverManager of
Doctrine\DBAL with comes with the Informix Platform or you can use the original
DriverManager class of Doctrine\DBAL, in this last case you will need to specify
the driver class to use.

### Creating a connection with the modified version of the DriverManager

Ifx4dd comes with a modified version of the DriverManager class that adds
`pdo_informix` as one of the possible drivers to use.

In this case, you need tell to `composer` that load the classes from the ifx4dd
directory tree in first place (if you have installed ifx4dd from the composer.json
what comes with ifx4dd it is not needed since the ifx4dd directory is added
in first place to the autoloader).

```php
    <?php

    // Gets the autoloader
    $classLoader = require_once 'vendor/autoload.php';

    // Adds the ifx4dd directory in first place to the
    // Doctrine\DBAL namespace
    $classLoader->add(
        'Doctrine\\DBAL\\',
        'vendor/josemalonsom/ifx4dd/lib',
        true
    );

    use Doctrine\DBAL\DriverManager;

    $connectionParams = array(
        'driver'       => 'pdo_informix',
        'host'         => 'hosttest1',
        'port'         => '50000',
        'protocol'     => 'onsoctcp',
        'server'       => 'test1tcp',
        'dbname'       => 'test_database',
        'user'         => 'user',
        'password'     => 'password',
    );

    $connection = DriverManager::getConnection($connectionParams);
```

### Creating a connection with the original DriverManager of DBAL

If you want to use the 'Doctrine\DBAL\DriverManager' class what comes with DBAL
you need to specify the driver class to use in the connection params as in the
next example:


```php
    <?php

    require_once 'vendor/autoload.php';

    use Doctrine\DBAL\DriverManager;

    $connectionParams = array(
        'driverClass'  => '\Doctrine\DBAL\Driver\PDOInformix\Driver',
        'host'         => 'hosttest1',
        'port'         => '50000',
        'protocol'     => 'onsoctcp',
        'server'       => 'test1tcp',
        'dbname'       => 'test_database',
        'user'         => 'user',
        'password'     => 'password',
    );

    $connection = DriverManager::getConnection($connectionParams);
```

### Creating a connection with a URL

Since DBAL 2.5 it is possible to use a URL to create the connection (note that
in this case you must use the ifx4dd DriverManager version).

```php
    <?php

    $classLoader = require_once 'vendor/autoload.php';

    $classLoader->add(
        'Doctrine\\DBAL\\',
        'vendor/josemalonsom/ifx4dd/lib',
        true
    );

    use Doctrine\DBAL\DriverManager;

    $connection = DriverManager::getConnection(array(
        'url' => 'informix://user:password@hosttest1:50000/test_database?protocol=onsoctcp&server=test1tcp'
    ));
```

Please, refer to the DBAL documentation for more information:
https://github.com/doctrine/dbal/blob/2.5/docs/en/reference/configuration.rst

## Delimited identifiers

DBAL uses delimited identifiers so you need to enable it in your Informix
environment, see [enabling delimited identifiers](http://www-01.ibm.com/support/knowledgecenter/SSGU8G_12.1.0/com.ibm.sqls.doc/ids_sqs_1667.htm?lang=en).

### Other documentation

- [Data type mapping](docs/types.md)

