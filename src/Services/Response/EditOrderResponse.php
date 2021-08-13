<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services\Response;

use DateTime;
use JMS\Serializer\Annotation as Serializer;
use Malinoff\PlastekBundle\Services\Response\Model\BasketItemCalculateModel;
use Malinoff\PlastekBundle\Services\Response\Model\TotalCalculateModel;

class EditOrderResponse implements ResponseInterface
{
    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("cashAmount")
     * @Serializer\Type("float")
     */
    private $cashAmount;

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
     * @Serializer\SerializedName("giftCardPrevBalance")
     * @Serializer\Type("float")
     */
    private $giftCardPrevBalance;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("giftCardBalance")
     * @Serializer\Type("float")
     */
    private $giftCardBalance;

    /**
     * @var TotalCalculateModel|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("totalCalculate")
     * @Serializer\Type("Malinoff\PlastekBundle\Services\Response\Model\TotalCalculateModel")
     */
    private $totalCalculate;

    /**
     * @var BasketItemCalculateModel[]
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("basketCalculate")
     * @Serializer\Type("array<Malinoff\PlastekBundle\Services\Response\Model\BasketItemCalculateModel>")
     */
    private $basketCalculate;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("clientMessage")
     * @Serializer\Type("string")
     */
    private $clientMessage;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("uuidTransaction")
     * @Serializer\Type("string")
     */
    private $uuidTransaction;

    /**
     * @var DateTime|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("transactionUtc")
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s'>")
     */
    private $transactionUtc;

    public function getCashAmount(): ?float
    {
        return $this->cashAmount;
    }

    public function getGiftCardRedeemAmount(): ?float
    {
        return $this->giftCardRedeemAmount;
    }

    public function getGiftCardPrevBalance(): ?float
    {
        return $this->giftCardPrevBalance;
    }

    public function getGiftCardBalance(): ?float
    {
        return $this->giftCardBalance;
    }

    public function getTotalCalculate(): ?TotalCalculateModel
    {
        return $this->totalCalculate;
    }

    /**
     * @return BasketItemCalculateModel[]
     */
    public function getBasketCalculate(): array
    {
        return $this->basketCalculate;
    }

    public function getClientMessage(): ?string
    {
        return $this->clientMessage;
    }

    public function getUuidTransaction(): ?string
    {
        return $this->uuidTransaction;
    }

    public function getTransactionUtc(): ?DateTime
    {
        return $this->transactionUtc;
    }
}
