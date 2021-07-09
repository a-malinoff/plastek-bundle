<?php

namespace Malinoff\PlastekBundle\Services\Response;

use DateTime;
use JMS\Serializer\Annotation as Serializer;

class GetOrderResponse implements ResponseInterface
{
    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("uuidOrder")
     * @Serializer\Type("string")
     */
    private $uuidOrder;

    /**
     * @var DateTime|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("serverUtc")
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s'>")
     */
    private $serverUtc;

    /**
     * @var DateTime|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("calculateDatetime")
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s'>")
     */
    private $calculateDatetime;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("total")
     * @Serializer\Type("float")
     */
    private $total;

    /**
     * @var int|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("giftCardNumber")
     * @Serializer\Type("integer")
     */
    private $giftCardNumber;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("giftCardRedeemAmount")
     * @Serializer\Type("float")
     */
    private $giftCardRedeemAmount;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("giftCardRedeemAmountMax")
     * @Serializer\Type("float")
     */
    private $giftCardRedeemAmountMax;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("state")
     * @Serializer\Type("string")
     */
    private $state;

    /**
     * @var bool|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("onlyAdd")
     * @Serializer\Type("boolean")
     */
    private $onlyAdd;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("bonusAmountMax")
     * @Serializer\Type("float")
     */
    private $bonusAmountMax;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("cardNumber")
     * @Serializer\Type("string")
     */
    private $cardNumber;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("redeemAmount")
     * @Serializer\Type("float")
     */
    private $redeemAmount;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("addAmount")
     * @Serializer\Type("float")
     */
    private $addAmount;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("discountAmount")
     * @Serializer\Type("float")
     */
    private $discountAmount;

    public function getUuidOrder(): ?string
    {
        return $this->uuidOrder;
    }

    public function getServerUtc(): ?DateTime
    {
        return $this->serverUtc;
    }

    public function getCalculateDatetime(): ?DateTime
    {
        return $this->calculateDatetime;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function getGiftCardNumber(): ?int
    {
        return $this->giftCardNumber;
    }

    public function getGiftCardRedeemAmount(): ?float
    {
        return $this->giftCardRedeemAmount;
    }

    public function getGiftCardRedeemAmountMax(): ?float
    {
        return $this->giftCardRedeemAmountMax;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function getOnlyAdd(): ?bool
    {
        return $this->onlyAdd;
    }

    public function getBonusAmountMax(): ?float
    {
        return $this->bonusAmountMax;
    }

    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    public function getRedeemAmount(): ?float
    {
        return $this->redeemAmount;
    }

    public function getAddAmount(): ?float
    {
        return $this->addAmount;
    }

    public function getDiscountAmount(): ?float
    {
        return $this->discountAmount;
    }
}
