
#Informix Platform for Doctrine DBAL#

The *Informix Platform for Doctrine DBAL*  gives support for Informix to
[Doctrine\DBAL](http://www.doctrine-project.org/projects/dbal.html) the database
abstraction layer of the [Doctrine project](http://www.doctrine-project.org).


##DBAL versions supported##

This branch attempts to follow the master branch of DBAL, there is a working
version with DBAL 2.5.0-BETA3 here https://github.com/josemalonsom/ifx4dd/tree/v0.1.0 .


##Informix versions supported##

It is tested on Informix Dynamic Server versions 11.50, 11.70 and 12.10.


##INSTALL##

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


##Getting a connection with Informix##

If you don't have experience with DBAL please read first its documentation
[Doctrine\DBAL documentation](http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest)

To create a connection you can use the modified version of the DriverManager of
Doctrine\DBAL with come with the Informix Platform or you can use the original
DriverManager class of Doctrine\DBAL, in this last case you need to specify the
driver class to use.


###Creating a connection with the modified version of the DriverManager###

Use this if you have installed Doctrine\DBAL as dependency of the Informix
Platform, the autoloader created by composer will load the modified version
of the DriverManager with come with the Informix Platform in first place, this
version adds *pdo_informix* as one of the possible drivers to use.

```php
    <?php

    // We need to get the autoader
    require_once 'vendor/autoload.php';

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


###Creating a connection with the original DriverManager of DBAL###

Use this when you already have a Doctrine\DBAL installation and you
added the Informix Platform classes in last place.

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

##Delimited identifiers##

DBAL uses delimited identifiers so you need to enable it in your Informix
environment, see [enabling delimited identifiers](http://www-01.ibm.com/support/knowledgecenter/SSGU8G_12.1.0/com.ibm.sqls.doc/ids_sqs_1667.htm?lang=en).

###Other documentation###

- [Data type mapping](https://github.com/josemalonsom/ifx4dd/blob/fix-data-type-doc/docs/types.md)

