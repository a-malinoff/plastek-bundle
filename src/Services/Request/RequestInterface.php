<?php

namespace Malinoff\PlastekBundle\Services\Request;

interface RequestInterface
{
    public function getAction(): string;

    public function getMethod(): string;

    public function getQuery(): array;

    public function getBody(): array;

    public function setVersion(?string $version);

    public function setUuid(?string $uuid);

    public function setTicks(?string $ticks);

    public function setLoginType(?string $loginType);
}
