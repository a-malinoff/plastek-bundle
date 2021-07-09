<?php

namespace Malinoff\PlastekBundle\Services\Response\Model;

use JMS\Serializer\Annotation as Serializer;

class DiscountModel
{
    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("uuid")
     * @Serializer\Type("string")
     */
    private $uuid;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("discountType")
     * @Serializer\Type("string")
     */
    private $discountType;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("discountValue")
     * @Serializer\Type("float")
     */
    private $discountValue;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("description")
     * @Serializer\Type("string")
     */
    private $description;

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function getDiscountType(): ?string
    {
        return $this->discountType;
    }

    public function getDiscountValue(): ?float
    {
        return $this->discountValue;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
