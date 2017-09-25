<?php

namespace Doctrine\Tests\DBAL\Driver\PDOInformix;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\PDOInformix\Driver;
use Doctrine\Tests\DBAL\Driver\AbstractInformixDriverTest;

class DriverTest extends AbstractInformixDriverTest
{
    public function testReturnsName()
    {
        $this->assertSame('pdo_informix', $this->driver->getName());
    }

    protected function createDriver()
    {
        return new Driver();
    }

    /**
     * @dataProvider exceptionMessagesOnMissingParameters
     */
    public function testThrowsExceptionOnMissingParameter(
        array $params, $exceptionMessage
    ) {

        $this->expectException(DBALException::class);
        $this->expectExceptionMessage($exceptionMessage);

        $this->driver->connect($params);
    }

    public function exceptionMessagesOnMissingParameters()
    {
        $data = array();

        $data['missing dbname'] = array(
            $this->getConnectionParamsWithoutKey('dbname'),
            "Missing 'dbname' in configuration for informix driver"
        );

        $data['missing host'] = array(
            $this->getConnectionParamsWithoutKey('host'),
            "Missing 'host' in configuration for informix driver"
        );

        $data['missing protocol'] = array(
            $this->getConnectionParamsWithoutKey('protocol'),
            "Missing 'protocol' in configuration for informix driver"
        );

        $data['missing server'] = array(
            $this->getConnectionParamsWithoutKey('server'),
            "Missing 'server' in configuration for informix driver"
        );

        return $data;
    }

    private function getConnectionParamsWithoutKey($excludedKey)
    {
        $allParams = array(
            'dbname'   => 'dbname',
            'host'     => 'host',
            'protocol' => 'protocol',
            'server'   => 'server',
        );

        $params = array();

        foreach($allParams as $key => $value) {
            if ($key != $excludedKey) {
                $params[$key] = $value;
            }
        }

        return $params;
    }
}
