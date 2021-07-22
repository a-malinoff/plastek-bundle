<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests\mocks;

use Malinoff\PlastekBundle\DependencyInjection\Compiler\FillPlastekFactoryInterface;

class ServiceWithFillPlastekFactory implements FillPlastekFactoryInterface
{
    public static function getMap(): array
    {
        return [];
    }
}
