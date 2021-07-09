<?php

namespace Malinoff\PlastekBundle\Services\Response\Model;

use JMS\Serializer\Annotation as Serializer;

class CouponModel
{
    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("number")
     * @Serializer\Type("string")
     */
    private $number;

    /**
     * @var DiscountModel
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("number")
     * @Serializer\Type("Malinoff\PlastekBundle\Services\Response\Model\DiscountModel")
     */
    private $discount;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("description")
     * @Serializer\Type("string")
     */
    private $description;

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function getDiscount(): DiscountModel
    {
        return $this->discount;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
