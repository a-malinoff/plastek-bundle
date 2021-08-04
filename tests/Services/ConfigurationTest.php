<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests\Services;

use Malinoff\PlastekBundle\Services\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    public function testGetters()
    {
        $apiUrl = 'test_api';
        $version = 'test_version';
        $password = 'test_password';
        $debug = true;
        $timeout = 30;

        $configuration = new Configuration(
            $apiUrl,
            $version,
            $password,
            $debug,
            $timeout
        );

        $this->assertSame($apiUrl, $configuration->getApiUrl());
        $this->assertSame($version, $configuration->getVersion());
        $this->assertSame($password, $configuration->getPassword());
        $this->assertSame($debug, $configuration->isDebug());
        $this->assertSame($timeout, $configuration->getTimeout());
    }
}
