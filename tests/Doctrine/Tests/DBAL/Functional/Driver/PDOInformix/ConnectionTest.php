<?php

namespace Doctrine\Tests\DBAL\Functional\Driver\PDOInformix;

use Doctrine\Tests\DbalFunctionalTestCase;

class ConnectionTest extends DbalFunctionalTestCase
{
    public function setUp()
    {
        parent::setUp();

        if ($this->_conn->getDatabasePlatform()->getName() != 'informix') {
            $this->markTestSkipped('This test only applies to PDO_INFORMIX');
        }

        $this->connection = $this->_conn->getWrappedConnection();
    }

    public function testGetServerVersion()
    {
        $this->assertRegExp(
            '/IBM Informix Dynamic Server Version [0-9]{2}\.[0-9]{2}\.(F|H|T|U)[[:alnum:]]+/',
            $this->connection->getServerVersion()
        );
    }

    public function testQuote()
    {
        $this->assertSame(1, $this->connection->quote(1, \PDO::PARAM_INT));
        $this->assertSame("'a'", $this->connection->quote("a"));
        $this->assertSame("'a'", $this->connection->quote("a", \PDO::PARAM_STR));
    }
}
