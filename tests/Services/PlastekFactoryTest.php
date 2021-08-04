<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests\Services;

use Exception;
use Malinoff\PlastekBundle\DependencyInjection\Compiler\FillPlastekFactoryInterface;
use Malinoff\PlastekBundle\Services\PlastekFactory;
use Malinoff\PlastekBundle\Services\Request\CalculateOrderRequest;
use Malinoff\PlastekBundle\Services\Request\CancelOrderRequest;
use Malinoff\PlastekBundle\Services\Request\ConfirmOrderRequest;
use Malinoff\PlastekBundle\Services\Request\CreateOrderRequest;
use Malinoff\PlastekBundle\Services\Request\CreateSimplyLoyaltyMemberRequest;
use Malinoff\PlastekBundle\Services\Request\EditOrderRequest;
use Malinoff\PlastekBundle\Services\Request\GetLoyaltyMemberRequest;
use Malinoff\PlastekBundle\Services\Request\GetOrderRequest;
use Malinoff\PlastekBundle\Services\Request\RequestInterface;
use Malinoff\PlastekBundle\Services\Response\CalculateOrderResponse;
use Malinoff\PlastekBundle\Services\Response\CancelOrderResponse;
use Malinoff\PlastekBundle\Services\Response\ConfirmOrderResponse;
use Malinoff\PlastekBundle\Services\Response\CreateOrderResponse;
use Malinoff\PlastekBundle\Services\Response\CreateSimplyLoyaltyMemberResponse;
use Malinoff\PlastekBundle\Services\Response\EditOrderResponse;
use Malinoff\PlastekBundle\Services\Response\GetLoyaltyMemberResponse;
use Malinoff\PlastekBundle\Services\Response\GetOrderResponse;
use Malinoff\PlastekBundle\Services\Response\ResponseInterface;
use Malinoff\PlastekBundle\Tests\mocks\TestRequest;
use Malinoff\PlastekBundle\Tests\mocks\TestResponse;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use ReflectionProperty;

class PlastekFactoryTest extends TestCase
{
    /** @var PlastekFactory */
    private $factory;

    public function setUp(): void
    {
        $this->factory = new PlastekFactory();
    }

    public function testNewPlastekFactory()
    {
        $property = new ReflectionProperty(PlastekFactory::class, 'map');
        $property->setAccessible(true);
        $map = $property->getValue($this->factory);

        $this->assertArrayHasKey(CalculateOrderRequest::class, $map);
        $this->assertArrayHasKey(CancelOrderRequest::class, $map);
        $this->assertArrayHasKey(ConfirmOrderRequest::class, $map);
        $this->assertArrayHasKey(CreateOrderRequest::class, $map);
        $this->assertArrayHasKey(CreateSimplyLoyaltyMemberRequest::class, $map);
        $this->assertArrayHasKey(EditOrderRequest::class, $map);
        $this->assertArrayHasKey(GetLoyaltyMemberRequest::class, $map);
        $this->assertArrayHasKey(GetOrderRequest::class, $map);

        $this->assertSame(CalculateOrderResponse::class, $map[CalculateOrderRequest::class]);
        $this->assertSame(CancelOrderResponse::class, $map[CancelOrderRequest::class]);
        $this->assertSame(ConfirmOrderResponse::class, $map[ConfirmOrderRequest::class]);
        $this->assertSame(CreateOrderResponse::class, $map[CreateOrderRequest::class]);
        $this->assertSame(CreateSimplyLoyaltyMemberResponse::class, $map[CreateSimplyLoyaltyMemberRequest::class]);
        $this->assertSame(EditOrderResponse::class, $map[EditOrderRequest::class]);
        $this->assertSame(GetLoyaltyMemberResponse::class, $map[GetLoyaltyMemberRequest::class]);
        $this->assertSame(GetOrderResponse::class, $map[GetOrderRequest::class]);
    }

    public function testCreateResponse()
    {
        $property = new ReflectionProperty(PlastekFactory::class, 'map');
        $property->setAccessible(true);
        $property->setValue($this->factory, [
            TestRequest::class => TestResponse::class,
        ]);
        $property->setAccessible(false);

        $request = new TestRequest();
        $response = $this->factory->createResponse($request);
        $this->assertInstanceOf(TestResponse::class, $response);

        $method = new ReflectionMethod(PlastekFactory::class, 'createResponse');

        $this->assertCount(1, $method->getParameters());
        $this->assertSame(RequestInterface::class, $method->getParameters()[0]->getType()->getName());
        $this->assertFalse($method->getParameters()[0]->getType()->allowsNull());
        $this->assertSame(ResponseInterface::class, $method->getReturnType()->getName());
        $this->assertFalse($method->getReturnType()->allowsNull());
    }

    public function testCreateResponseException()
    {
        $request = new TestRequest();

        $this->expectException(Exception::class);
        $this->factory->createResponse($request);
    }

    public function testFillMap()
    {
        $method = new ReflectionMethod(PlastekFactory::class, 'fillMap');

        $this->assertCount(1, $method->getParameters());
        $this->assertSame(FillPlastekFactoryInterface::class, $method->getParameters()[0]->getType()->getName());
        $this->assertFalse($method->getParameters()[0]->getType()->allowsNull());
        $this->assertSame('void', $method->getReturnType()->getName());
    }

    public function testAddMap()
    {
        $method = new ReflectionMethod(PlastekFactory::class, 'addMap');

        $this->assertCount(1, $method->getParameters());
        $this->assertSame('array', $method->getParameters()[0]->getType()->getName());
        $this->assertFalse($method->getParameters()[0]->getType()->allowsNull());
        $this->assertSame('void', $method->getReturnType()->getName());

        $method->setAccessible(true);
        $method->invoke($this->factory, [
            TestRequest::class => TestResponse::class,
            \stdClass::class => \stdClass::class,
        ]);

        $property = new ReflectionProperty(PlastekFactory::class, 'map');
        $property->setAccessible(true);

        $map = $property->getValue($this->factory);

        $this->assertSame(TestResponse::class, $map[TestRequest::class]);
        $this->assertArrayHasKey(TestRequest::class, $map);
        $this->assertArrayNotHasKey(\stdClass::class, $map);
    }
}
