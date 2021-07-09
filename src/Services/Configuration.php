<?php

namespace Malinoff\PlastekBundle\Services;

class Configuration
{
    private $apiUrl;

    private $version;

    private $password;

    private $debug;

    private $timeout;

    public function __construct(
        string $apiUrl,
        string $version,
        string $password,
        bool $debug,
        int $timeout
    ) {
        $this->apiUrl = $apiUrl;
        $this->version = $version;
        $this->password = $password;
        $this->debug = $debug;
        $this->timeout = $timeout;
    }

    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function isDebug(): bool
    {
        return $this->debug;
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }
}
