<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\DependencyInjection\Compiler;

interface FillPlastekFactoryInterface
{
    public static function getMap(): array;
}
