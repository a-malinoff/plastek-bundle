<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests\mocks;

use Symfony\Contracts\HttpClient\ResponseInterface;

class TestHttpResponse implements ResponseInterface
{
    private $body;

    private $statusCode;

    public function __construct(array $body, int $statusCode)
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(bool $throw = true): array
    {
        return [];
    }

    public function getContent(bool $throw = true): string
    {
        return json_encode($this->body);
    }

    public function toArray(bool $throw = true): array
    {
        return [];
    }

    public function cancel(): void
    {
    }

    public function getInfo(string $type = null)
    {
    }
}
