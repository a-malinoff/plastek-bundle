<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests\DependencyInjection;

use Malinoff\PlastekBundle\DependencyInjection\Compiler\FillPlastekFactoryInterface;
use Malinoff\PlastekBundle\DependencyInjection\MalinoffPlastekExtension;
use Malinoff\PlastekBundle\Services\Configuration;
use Malinoff\PlastekBundle\Services\PlastekClient;
use Malinoff\PlastekBundle\Services\PlastekFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\Yaml\Yaml;

class MalinoffPlastekExtensionTest extends KernelTestCase
{
    public function testLoadAutoConfigurationTag()
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.environment', 'test');

        $this->load([], $container);

        $this->assertArrayHasKey(
            'malinoff.fill_plastek_factory_tag',
            $container->getAutoconfiguredInstanceof()[FillPlastekFactoryInterface::class]->getTags()
        );
    }

    public function testLoadSetServices()
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.environment', 'test');

        $this->load([], $container);

        $this->assertInstanceOf(Definition::class, $container->getDefinition(Configuration::class));
        $this->assertInstanceOf(Definition::class, $container->getDefinition(PlastekClient::class));
        $this->assertInstanceOf(Definition::class, $container->getDefinition(PlastekFactory::class));
    }

    public function testLoadSetParameters()
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.environment', 'test');

        $this->load(Yaml::parse(file_get_contents(__DIR__.'/../config/plastek.yaml')), $container);

        $this->assertSame('https://plastek.ru', $container->getParameter('plastek.api_url'));
        $this->assertSame('plastek_version', $container->getParameter('plastek.version'));
        $this->assertSame('plastek_password', $container->getParameter('plastek.password'));
        $this->assertSame(false, $container->getParameter('plastek.debug'));
        $this->assertSame(30, $container->getParameter('plastek.timeout'));
    }

    public function testLoadDefaulParameters()
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.environment', 'test');

        $this->load([], $container);

        $this->assertNotEmpty($container->getParameter('plastek.api_url'));
        $this->assertNotEmpty($container->getParameter('plastek.version'));
        $this->assertNotEmpty($container->getParameter('plastek.timeout'));
    }

    protected function load(array $config, ContainerBuilder $container)
    {
        (new MalinoffPlastekExtension())->load($config, $container);
    }
}
