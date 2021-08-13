<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services\Response\Model;

use JMS\Serializer\Annotation as Serializer;

class CalculateModel
{
    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("discount")
     * @Serializer\Type("float")
     */
    private $discount;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("addBonus")
     * @Serializer\Type("float")
     */
    private $addBonus;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("addBonusCurrency")
     * @Serializer\Type("float")
     */
    private $addBonusCurrency;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("redeemBonus")
     * @Serializer\Type("float")
     */
    private $redeemBonus;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("redeemBonusCurrency")
     * @Serializer\Type("float")
     */
    private $redeemBonusCurrency;

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function getAddBonus(): ?float
    {
        return $this->addBonus;
    }

    public function getAddBonusCurrency(): ?float
    {
        return $this->addBonusCurrency;
    }

    public function getRedeemBonus(): ?float
    {
        return $this->redeemBonus;
    }

    public function getRedeemBonusCurrency(): ?float
    {
        return $this->redeemBonusCurrency;
    }
}
