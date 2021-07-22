<?php

namespace Malinoff\PlastekBundle\DependencyInjection\Compiler;

use Malinoff\PlastekBundle\Services\PlastekFactory;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class FillPlastekFactoryCompilerPass implements CompilerPassInterface
{
    public const TAG = 'malinoff.fill_plastek_factory_tag';

    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(PlastekFactory::class)) {
            throw new \RuntimeException(sprintf('Requires available service %s in the container', PlastekFactory::class));
        }

        $definition = $container->getDefinition(PlastekFactory::class);

        $taggedServiceIds = $container->findTaggedServiceIds(self::TAG);

        foreach ($taggedServiceIds as $id => $tagOptions) {
            $taggedDefinition = $container->getDefinition($id);

            if (!in_array(FillPlastekFactoryInterface::class, class_implements($taggedDefinition->getClass()))) {
                throw new \RuntimeException(sprintf('Service %s with tag %s must implement interface %s', $id, self::TAG, FillPlastekFactoryInterface::class));
            }

            $definition->addMethodCall('fillMap', [new Reference($id)]);
        }
    }
}
