<?php

namespace Malinoff\PlastekBundle\Services;

use Exception;
use Malinoff\PlastekBundle\DependencyInjection\Compiler\FillPlastekFactoryInterface;
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

final class PlastekFactory
{
    private const REQUEST_RESPONSE_MAP = [
        CreateOrderRequest::class => CreateOrderResponse::class,
        EditOrderRequest::class => EditOrderResponse::class,
        CalculateOrderRequest::class => CalculateOrderResponse::class,
        CancelOrderRequest::class => CancelOrderResponse::class,
        ConfirmOrderRequest::class => ConfirmOrderResponse::class,
        GetLoyaltyMemberRequest::class => GetLoyaltyMemberResponse::class,
        CreateSimplyLoyaltyMemberRequest::class => CreateSimplyLoyaltyMemberResponse::class,
        GetOrderRequest::class => GetOrderResponse::class,
    ];

    private $map = [];

    public function __construct()
    {
        $this->addMap(self::REQUEST_RESPONSE_MAP);
    }

    /**
     * @throws Exception
     */
    public function createResponse(RequestInterface $request): ResponseInterface
    {
        $requestClass = get_class($request);

        try {
            $class = $this->map[$requestClass];

            return new $class();
        } catch (Exception $exception) {
            throw new Exception(sprintf('Can\'t find matched Response Class for %s', $requestClass));
        }
    }

    public function fillMap(FillPlastekFactoryInterface $factory): void
    {
        $this->addMap($factory::getMap());
    }

    private function addMap(array $map): void
    {
        foreach ($map as $requestClass => $responseClass) {
            if (!in_array(RequestInterface::class, class_implements($requestClass))) {
                continue;
            }

            if (!in_array(ResponseInterface::class, class_implements($responseClass))) {
                continue;
            }

            $this->map[$requestClass] = $responseClass;
        }
    }
}
