<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase as BaseKernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class KernelTestCase extends BaseKernelTestCase
{
    protected static function getContainer(): ContainerInterface
    {
        if (!static::$booted) {
            self::$kernel = static::bootKernel();
        }

        return self::$kernel->getContainer();
    }

    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }
}
