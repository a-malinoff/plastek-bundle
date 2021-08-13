<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services\Response\Model;

use JMS\Serializer\Annotation as Serializer;

class CardModel
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
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("description")
     * @Serializer\Type("string")
     */
    private $description;

    /**
     * @var int|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("bonusPercentAdd")
     * @Serializer\Type("integer")
     */
    private $bonusPercentAdd;

    /**
     * @var int|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("bonusPercentRedeem")
     * @Serializer\Type("integer")
     */
    private $bonusPercentRedeem;

    /**
     * @var PaymentModel[]
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("payments")
     * @Serializer\Type("array<Malinoff\PlastekBundle\Services\Response\Model\PaymentModel>")
     */
    private $payments;

    /**
     * @var DiscountModel[]
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("discounts")
     * @Serializer\Type("array<Malinoff\PlastekBundle\Services\Response\Model\DiscountModel>")
     */
    private $discounts;

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getBonusPercentAdd(): ?int
    {
        return $this->bonusPercentAdd;
    }

    public function getBonusPercentRedeem(): ?int
    {
        return $this->bonusPercentRedeem;
    }

    /**
     * @return PaymentModel[]
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
     * @return DiscountModel[]
     */
    public function getDiscounts(): array
    {
        return $this->discounts;
    }
}
