<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests\mocks;

use Malinoff\PlastekBundle\Services\FillPlastekFactoryInterface;

class FillPlastekFactoryService implements FillPlastekFactoryInterface
{
    public static function getMap(): array
    {
        return [
            TestRequest::class => TestResponse::class,
        ];
    }
}
