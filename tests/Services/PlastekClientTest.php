<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests\Services;

use Exception;
use Malinoff\PlastekBundle\Services\Configuration;
use Malinoff\PlastekBundle\Services\Exception\ErrorResponse;
use Malinoff\PlastekBundle\Services\Exception\PlastekException;
use Malinoff\PlastekBundle\Services\PlastekClient;
use Malinoff\PlastekBundle\Services\PlastekFactory;
use Malinoff\PlastekBundle\Tests\mocks\MockLogger;
use Malinoff\PlastekBundle\Tests\mocks\MockValidator;
use Malinoff\PlastekBundle\Tests\mocks\TestHttpResponse;
use Malinoff\PlastekBundle\Tests\mocks\TestRequest;
use Malinoff\PlastekBundle\Tests\mocks\TestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;
use Symfony\Component\HttpClient\MockHttpClient;
use Throwable;

class PlastekClientTest extends TestCase
{
    /** @var PlastekClient */
    private $client;

    public function setUp(): void
    {
        $configuration = new Configuration(
            'https://plastek.ru',
            'plastek_version',
            'plastek_password',
            false,
            30
        );

        $factory = new PlastekFactory();
        $property = new ReflectionProperty(PlastekFactory::class, 'map');
        $property->setAccessible(true);
        $property->setValue($factory, [
            TestRequest::class => TestResponse::class,
        ]);
        $property->setAccessible(false);

        $this->client = new PlastekClient(
            $configuration,
            $factory,
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

    public function testCorrectResponse()
    {
        $httpClient = new MockHttpClient(new TestHttpResponse([
            'fieldOne' => 'test_field_one',
            'fieldTwo' => 'test_field_two',
            'fieldThree' => 'test_field_three',
        ], 200));

        $property = new ReflectionProperty(PlastekClient::class, 'httpClient');
        $property->setAccessible(true);
        $property->setValue($this->client, $httpClient);
        $property->setAccessible(false);

        /** @var TestResponse $response */
        $response = $this->client->send(new TestRequest());

        $this->assertSame('test_field_one', $response->fieldOne);
        $this->assertSame('test_field_two', $response->fieldTwo);
        $this->assertSame('test_field_three', $response->fieldThree);
    }

    public function testUnCorrectResponse()
    {
        $httpClient = new MockHttpClient(new TestHttpResponse([], 400));

        $property = new ReflectionProperty(PlastekClient::class, 'httpClient');
        $property->setAccessible(true);
        $property->setValue($this->client, $httpClient);
        $property->setAccessible(false);

        $this->expectException(Exception::class);

        $this->client->send(new TestRequest());
    }

    public function testPlastekException()
    {
        $errorLevel = ';5';
        $errorId = '12345';
        $errorText = 'Example error text';

        $httpClient = new MockHttpClient(new TestHttpResponse([
            'error' => sprintf('%s#%s#%s', $errorLevel, $errorId, $errorText),
        ], 400));

        $property = new ReflectionProperty(PlastekClient::class, 'httpClient');
        $property->setAccessible(true);
        $property->setValue($this->client, $httpClient);
        $property->setAccessible(false);

        $this->expectException(PlastekException::class);

        try {
            $this->client->send(new TestRequest());
        } catch (Throwable $exception) {
            $this->assertInstanceOf(PlastekException::class, $exception);
            $this->assertSame(ErrorResponse::ERROR_LEVEL_VIEW, $exception->getErrorResponse()->getErrorLevel());
            $this->assertSame(intval($errorId), $exception->getErrorResponse()->getIdError());
            $this->assertSame($errorText, $exception->getErrorResponse()->getText());

            throw $exception;
        }
    }
}
