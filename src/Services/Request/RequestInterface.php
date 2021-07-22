<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services\Request;

interface RequestInterface
{
    public function getAction(): string;

    public function getMethod(): string;

    public function getQuery(): array;

    public function getBody(): array;

    /**
     * @return mixed
     */
    public function setVersion(?string $version);

    /**
     * @return mixed
     */
    public function setUuid(?string $uuid);

    /**
     * @return mixed
     */
    public function setTicks(?string $ticks);

    /**
     * @return mixed
     */
    public function setLoginType(?string $loginType);
}
