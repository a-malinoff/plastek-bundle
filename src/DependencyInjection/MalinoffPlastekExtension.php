<?php

namespace Malinoff\PlastekBundle\DependencyInjection;

use Malinoff\PlastekBundle\DependencyInjection\Compiler\FillPlastekFactoryInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class MalinoffPlastekExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $container->registerForAutoconfiguration(FillPlastekFactoryInterface::class)
            ->addTag('malinoff.fill_plastek_factory_tag')
        ;

        $configuration = new Configuration($container);
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('plastek.api_url', $config['api_url']);
        $container->setParameter('plastek.version', $config['version']);
        $container->setParameter('plastek.password', $config['password']);
        $container->setParameter('plastek.debug', $config['debug']);
        $container->setParameter('plastek.timeout', $config['timeout']);
    }
}
