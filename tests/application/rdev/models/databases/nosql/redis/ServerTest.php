<?php
/**
 * Copyright (C) 2014 David Young
 *
 * Tests the Redis server
 */
namespace RDev\Models\Databases\NoSQL\Redis;

class ServerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests setting the display name
     */
    public function testSettingDisplayName()
    {
        $displayName = 'nicename';
        $server = $this->getMockForAbstractClass("RDev\\Models\\Databases\\NoSQL\\Redis\\Server");
        $server->setDisplayName($displayName);
        $this->assertEquals($displayName, $server->getDisplayName());
    }

    /**
     * Tests setting the host
     */
    public function testSettingHost()
    {
        $host = '127.0.0.1';
        $server = $this->getMockForAbstractClass("RDev\\Models\\Databases\\NoSQL\\Redis\\Server");
        $server->setHost($host);
        $this->assertEquals($host, $server->getHost());
    }

    /**
     * Tests setting the port
     */
    public function testSettingPort()
    {
        $port = 11211;
        $server = $this->getMockForAbstractClass("RDev\\Models\\Databases\\NoSQL\\Redis\\Server");
        $server->setPort($port);
        $this->assertEquals($port, $server->getPort());
    }
} 