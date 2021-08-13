<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

abstract class BaseKernelTestCase extends KernelTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (!static::$booted) {
            self::$kernel = static::bootKernel();
        }
    }

    protected static function getKernel(): KernelInterface
    {
        return self::$kernel;
    }

    protected static function getContainer(): ContainerInterface
    {
        return self::$kernel->getContainer();
    }

    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }
}
