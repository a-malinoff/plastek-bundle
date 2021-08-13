<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services\Response\Model;

use JMS\Serializer\Annotation as Serializer;

class BasketItemCalculateModel
{
    /**
     * @var int|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("id")
     * @Serializer\Type("integer")
     */
    private $id;

    /**
     * @var CalculateModel|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("calculate")
     * @Serializer\Type("Malinoff\PlastekBundle\Services\Response\Model\CalculateModel")
     */
    private $calculate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCalculate(): ?CalculateModel
    {
        return $this->calculate;
    }
}
