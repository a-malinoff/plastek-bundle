<?php

namespace Malinoff\PlastekBundle\Services\Request;

use DateTime;
use Malinoff\PlastekBundle\Services\Request\Model\BasketItemModel;
use Malinoff\PlastekBundle\Services\Request\Model\GiftCardModel;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class CreateOrderRequest extends BaseRequest
{
    /**
     * @var string|null
     */
    private $userLogin;

    /**
     * @var string|null
     */
    private $uuidOrder;

    /**
     * @var string|null
     */
    private $promoCode;

    /**
     * @var GiftCardModel|null
     */
    private $giftCard;

    /**
     * @var float|null
     */
    private $bonusAmountMax;

    /**
     * @var float|null
     */
    private $giftCardRedeemAmountMax;

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
        return sprintf('/api/%s/Order/%s/%s/%s/Create',
            $this->version,
            $this->uuid,
            $this->ticks,
            $this->loginType
        );
    }

    public function getMethod(): string
    {
        return self::METHOD_POST;
    }

    public function getBody(): array
    {
        return [
            'userLogin' => $this->userLogin,
            'uuidOrder' => $this->uuidOrder,
            'promoCode' => $this->promoCode,
            'giftCard' => $this->giftCard,
            'bonusAmountMax' => $this->bonusAmountMax,
            'giftCardRedeemAmountMax' => $this->giftCardRedeemAmountMax,
            'calculateDatetime' => $this->calculateDatetime instanceof DateTime
                ? $this->calculateDatetime->format('Y-m-d\TH:i:s.uP') : $this->calculateDatetime,
            'total' => $this->total,
            'onlyAdd' => empty($this->bonusAmountMax),
            'basket' => $this->basket,
        ];
    }

    public function setUserLogin(?string $userLogin): self
    {
        $this->userLogin = $userLogin;

        return $this;
    }

    public function getUuidOrder(): ?string
    {
        return $this->uuidOrder;
    }

    public function setUuidOrder(?string $uuidOrder): self
    {
        $this->uuidOrder = $uuidOrder;

        return $this;
    }

    public function setPromoCode(?string $promoCode): self
    {
        $this->promoCode = $promoCode;

        return $this;
    }

    public function setGiftCard(?GiftCardModel $giftCard): self
    {
        $this->giftCard = $giftCard;

        return $this;
    }

    public function setBonusAmountMax(?float $bonusAmountMax): self
    {
        $this->bonusAmountMax = $bonusAmountMax;

        return $this;
    }

    public function setGiftCardRedeemAmountMax(?float $giftCardRedeemAmountMax): self
    {
        $this->giftCardRedeemAmountMax = $giftCardRedeemAmountMax;

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

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        parent::loadValidatorMetadata($metadata);

        $metadata->addPropertyConstraint('loginType', new Assert\NotBlank([
            'groups' => ['request'],
        ]));
    }
}
