<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests\mocks;

use Malinoff\PlastekBundle\Services\Request\RequestInterface;

class TestRequest implements RequestInterface
{
    public function getAction(): string
    {
        return 'test/action';
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getQuery(): array
    {
        return [
            'param1' => 'value1',
            'param2' => 'value2',
        ];
    }

    public function getBody(): array
    {
        return [
            'param3' => 'value3',
            'param4' => 'value4',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function setVersion(?string $version)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function setUuid(?string $uuid)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function setTicks(?string $ticks)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function setLoginType(?string $loginType)
    {
    }
}
