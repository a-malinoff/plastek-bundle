<?php

namespace Malinoff\PlastekBundle\Tests;

use Exception;
use Malinoff\PlastekBundle\MalinoffPlastekBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

class TestKernel extends Kernel
{
    protected function build(ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addCompilerPass(new TestCompilerPass());
    }

    public function registerBundles(): array
    {
        return [
            new MalinoffPlastekBundle(),
        ];
    }

    /**
     * @throws Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/plastek.yaml');
    }
}
