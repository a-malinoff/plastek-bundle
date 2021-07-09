<?php

namespace Malinoff\PlastekBundle;

use Malinoff\PlastekBundle\DependencyInjection\Compiler\FillPlastekFactoryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MalinoffPlastekBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new FillPlastekFactoryCompilerPass());
    }
}
