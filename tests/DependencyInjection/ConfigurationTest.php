<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests\DependencyInjection;

use Malinoff\PlastekBundle\DependencyInjection\Configuration;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ConfigurationTest extends KernelTestCase
{
    public function testGetConfigTreeBuilder()
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.environment', 'test');

        $treeBuilder = (new Configuration($container))->getConfigTreeBuilder();

        $parameterDefinitions = $treeBuilder->getRootNode()->getChildNodeDefinitions();

        $this->assertArrayHasKey('api_url', $parameterDefinitions);
        $this->assertArrayHasKey('version', $parameterDefinitions);
        $this->assertArrayHasKey('password', $parameterDefinitions);
        $this->assertArrayHasKey('debug', $parameterDefinitions);
        $this->assertArrayHasKey('timeout', $parameterDefinitions);
    }
}
