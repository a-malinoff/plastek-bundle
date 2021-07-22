<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Configuration implements ConfigurationInterface
{
    private $container;

    public function __construct(ContainerBuilder $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('plastek');

        $env = $this->container->getParameter('kernel.environment');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('api_url')->defaultValue('https://delivery-svc.plas-tek.ru/CoreDelivery')->end()
            ->scalarNode('version')->defaultValue('v1')->end()
            ->scalarNode('password')->defaultValue('')->end()
            ->scalarNode('debug')->defaultValue('dev' === $env)->end()
            ->scalarNode('timeout')->defaultValue(30)->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
