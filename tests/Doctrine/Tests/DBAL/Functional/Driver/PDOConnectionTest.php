<?php

namespace Doctrine\Tests\DBAL\Functional\Driver;

use Doctrine\DBAL\Driver\PDOConnection;
use Doctrine\Tests\DbalFunctionalTestCase;

class PDOConnectionTest extends DbalFunctionalTestCase
{
    /**
     * The PDO driver connection under test.
     *
     * @var \Doctrine\DBAL\Driver\PDOConnection
     */
    protected $driverConnection;

    /**
     * @var \Doctrine\DBAL\Platforms\AbstractPlatform
     */
    protected $platform;

    protected function setUp()
    {
        if ( ! extension_loaded('PDO')) {
            $this->markTestSkipped('PDO is not installed.');
        }

        parent::setUp();

        $this->driverConnection = $this->_conn->getWrappedConnection();
        $this->platform = $this->_conn->getDatabasePlatform();

        if ( ! $this->_conn->getWrappedConnection() instanceof PDOConnection) {
            $this->markTestSkipped('PDO connection only test.');
        }
    }

    public function testDoesNotRequireQueryForServerVersion()
    {
        if ( $this->platform->getName() == 'informix' ) {
            $this->markTestSkipped('This test does not apply to PDO_INFORMIX');
        }

        $this->assertFalse($this->driverConnection->requiresQueryForServerVersion());
    }

    public function testRequireQueryForServerVersion()
    {
        if ( $this->platform->getName() != 'informix' ) {
            $this->markTestSkipped('This test only applies to PDO_INFORMIX');
        }

        $this->assertTrue($this->driverConnection->requiresQueryForServerVersion());
    }

}
