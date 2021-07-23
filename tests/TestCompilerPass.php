<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests;

use Malinoff\PlastekBundle\Services\Configuration;
use Malinoff\PlastekBundle\Services\PlastekFactory;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TestCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$this->isPHPUnit()) {
            return;
        }

        $container->getDefinition(Configuration::class)
            ->setPublic(true)
        ;

        $container->getDefinition(PlastekFactory::class)
            ->setPublic(true)
        ;
    }

    private function isPHPUnit(): bool
    {
        return defined('PHPUNIT_COMPOSER_INSTALL') || defined('__PHPUNIT_PHAR__');
    }
}
