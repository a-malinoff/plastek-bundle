<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests\Services;

use Malinoff\PlastekBundle\Services\Configuration;
use Malinoff\PlastekBundle\Services\PlastekClient;
use Malinoff\PlastekBundle\Services\PlastekFactory;
use Malinoff\PlastekBundle\Tests\mocks\MockLogger;
use Malinoff\PlastekBundle\Tests\mocks\MockValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;

class PlastekClientTest extends TestCase
{
    /** @var PlastekClient */
    private $client;

    public function setUp(): void
    {
        $this->client = new PlastekClient(
            $this->createMock(Configuration::class),
            new PlastekFactory(),
            new MockHttpClient(),
            new MockLogger(),
            new MockValidator()
        );
    }

    public function testGetUuidOrder()
    {
        $isValid = (1 === preg_match('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?'.
            '[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $this->client::getUuidOrder()));

        $this->assertTrue($isValid);
    }
}
