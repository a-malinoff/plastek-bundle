<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services\Response;

use DateTime;
use JMS\Serializer\Annotation as Serializer;
use Malinoff\PlastekBundle\Services\Response\Model\CardModel;
use Malinoff\PlastekBundle\Services\Response\Model\CouponModel;
use Malinoff\PlastekBundle\Services\Response\Model\LinkModel;

class GetLoyaltyMemberResponse implements ResponseInterface
{
    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("firstName")
     * @Serializer\Type("string")
     */
    private $firstName;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("lastName")
     * @Serializer\Type("string")
     */
    private $lastName;

    /**
     * @var DateTime
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("birthday")
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s'>")
     */
    private $birthday;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("phoneNumber")
     * @Serializer\Type("string")
     */
    private $phoneNumber;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("email")
     * @Serializer\Type("string")
     */
    private $email;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("applicationStatus")
     * @Serializer\Type("string")
     */
    private $applicationStatus;

    /**
     * @var CardModel[]
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("cards")
     * @Serializer\Type("array<Malinoff\PlastekBundle\Services\Response\Model\CardModel>")
     */
    private $cards;

    /**
     * @var CouponModel[]
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("coupons")
     * @Serializer\Type("array<Malinoff\PlastekBundle\Services\Response\Model\CouponModel>")
     */
    private $coupons;

    /**
     * @var LinkModel[]
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("links")
     * @Serializer\Type("array<Malinoff\PlastekBundle\Services\Response\Model\LinkModel>")
     */
    private $links;

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getApplicationStatus(): ?string
    {
        return $this->applicationStatus;
    }

    /**
     * @return CardModel[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @return CouponModel[]
     */
    public function getCoupons(): array
    {
        return $this->coupons;
    }

    /**
     * @return LinkModel[]
     */
    public function getLinks(): array
    {
        return $this->links;
    }
}
