<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests;

use Malinoff\PlastekBundle\DependencyInjection\MalinoffPlastekExtension;
use Malinoff\PlastekBundle\MalinoffPlastekBundle;
use Malinoff\PlastekBundle\Services\Configuration;
use Malinoff\PlastekBundle\Services\PlastekClient;
use Malinoff\PlastekBundle\Services\PlastekFactory;

class MalinoffPlastekBundleTest extends BaseKernelTestCase
{
    public function testBootBundle()
    {
        $bundle = $this->getKernel()->getBundle('MalinoffPlastekBundle');

        $this->assertInstanceOf(MalinoffPlastekBundle::class, $bundle);
        $this->assertInstanceOf(MalinoffPlastekExtension::class, $bundle->getContainerExtension());
    }

    public function testSetParameters()
    {
        //expected parameters from yaml file: tests/config/plastek.yaml
        $this->assertSame('https://plastek.ru', $this->getContainer()->getParameter('plastek.api_url'));
        $this->assertSame('plastek_version', $this->getContainer()->getParameter('plastek.version'));
        $this->assertSame('plastek_password', $this->getContainer()->getParameter('plastek.password'));
        $this->assertSame(false, $this->getContainer()->getParameter('plastek.debug'));
        $this->assertSame(30, $this->getContainer()->getParameter('plastek.timeout'));
    }

    public function testHasServices()
    {
        $this->assertTrue($this->getContainer()->has(Configuration::class));
        $this->assertTrue($this->getContainer()->has(PlastekClient::class));
        $this->assertTrue($this->getContainer()->has(PlastekFactory::class));
    }
}
