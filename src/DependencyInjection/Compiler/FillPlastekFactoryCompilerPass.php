<?php

declare(strict_types=1);

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
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(PlastekFactory::class)) {
            throw new \RuntimeException(sprintf('Requires available service %s in the container', PlastekFactory::class));
        }

        $definition = $container->getDefinition(PlastekFactory::class);

        $taggedServiceIds = $container->findTaggedServiceIds(self::TAG);

        foreach ($taggedServiceIds as $id => $tagOptions) {
            $taggedDefinition = $container->getDefinition($id);

            $taggedDefinitionInterfaces = class_implements($taggedDefinition->getClass());

            if (false === $taggedDefinitionInterfaces || !in_array(FillPlastekFactoryInterface::class, $taggedDefinitionInterfaces)) {
                throw new \RuntimeException(sprintf('Service %s with tag %s must implement interface %s', $id, self::TAG, FillPlastekFactoryInterface::class));
            }

            $definition->addMethodCall('fillMap', [new Reference($id)]);
        }
    }
}
