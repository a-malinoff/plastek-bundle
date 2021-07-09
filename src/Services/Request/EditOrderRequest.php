<?php

namespace Malinoff\PlastekBundle\Services\Request;

use DateTime;
use Malinoff\PlastekBundle\Services\Request\Model\BasketItemModel;

class EditOrderRequest extends BaseRequest
{
    /**
     * @var string|null
     */
    private $uuidOrder;

    /**
     * @var DateTime|null
     */
    private $calculateDatetime;

    /**
     * @var float|null
     */
    private $total;

    /**
     * @var BasketItemModel[]|null
     */
    private $basket;

    public function getAction(): string
    {
        return sprintf('/api/%s/Shipment/%s/%s/Edit',
            $this->version,
            $this->uuid,
            $this->ticks
        );
    }

    public function getMethod(): string
    {
        return self::METHOD_PUT;
    }

    public function getBody(): array
    {
        return [
            'uuidOrder' => $this->uuidOrder,
            'calculateDatetime' => $this->calculateDatetime instanceof DateTime
                ? $this->calculateDatetime->format('Y-m-d\TH:i:s.uP') : $this->calculateDatetime,
            'total' => $this->total,
            'basket' => $this->basket,
        ];
    }

    public function setUuidOrder(?string $uuidOrder): self
    {
        $this->uuidOrder = $uuidOrder;

        return $this;
    }

    public function setCalculateDatetime(?DateTime $calculateDatetime): self
    {
        $this->calculateDatetime = $calculateDatetime;

        return $this;
    }

    public function setTotal(?float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function setBasket(?array $basket): self
    {
        $this->basket = $basket;

        return $this;
    }

    public function addBasket(BasketItemModel $basketItem): self
    {
        $this->basket[] = $basketItem;

        return $this;
    }
}
