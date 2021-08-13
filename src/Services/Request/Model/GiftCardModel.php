<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services\Request\Model;

use JMS\Serializer\Annotation as Serializer;

class GiftCardModel
{
    /**
     * @var int|null
     *
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("cardNumber")
     * @Serializer\Type("integer")
     */
    private $cardNumber;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("pin")
     * @Serializer\Type("string")
     */
    private $pin;

    public function setCardNumber(?int $cardNumber): self
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    public function setPin(?string $pin): self
    {
        $this->pin = $pin;

        return $this;
    }
}
