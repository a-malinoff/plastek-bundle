<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services\Request\Model;

use JMS\Serializer\Annotation as Serializer;

class BasketItemModel
{
    public const MEASSURE_NAME_MAP = [
        'pcs' => 'PIECE',
        'kg' => 'WEIGHT',
    ];
    public const TYPE_PRODUCT = 'PRODUCT';
    public const FLAG_CALCULATE_ALLOWED = 'ALLOWED';

    /**
     * @var int|null
     *
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("id")
     * @Serializer\Type("integer")
     */
    private $id;

    /**
     * @var int|null
     *
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("parentId")
     * @Serializer\Type("integer")
     */
    private $parentId;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("sku")
     * @Serializer\Type("string")
     */
    private $sku;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("quantity")
     * @Serializer\Type("float")
     */
    private $quantity;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("price")
     * @Serializer\Type("float")
     */
    private $price;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("total")
     * @Serializer\Type("float")
     */
    private $total;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("categoryCode")
     * @Serializer\Type("string")
     */
    private $categoryCode;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("categoryName")
     * @Serializer\Type("string")
     */
    private $categoryName;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("type")
     * @Serializer\Type("string")
     */
    private $type;

    /**
     * @var bool|null
     *
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("group")
     * @Serializer\Type("boolean")
     */
    private $group;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("meassureName")
     * @Serializer\Type("string")
     */
    private $meassureName;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"request"})
     * @Serializer\SerializedName("flagCalculate")
     * @Serializer\Type("string")
     */
    private $flagCalculate;

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setParentId(?int $parentId): self
    {
        $this->parentId = $parentId;

        return $this;
    }

    public function setSku(?string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function setQuantity(?float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function setTotal(?float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setCategoryCode(?string $categoryCode): self
    {
        $this->categoryCode = $categoryCode;

        return $this;
    }

    public function setCategoryName(?string $categoryName): self
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setGroup(?bool $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function setMeassureName(?string $meassureName): self
    {
        $this->meassureName = $meassureName;

        return $this;
    }

    public function setFlagCalculate(?string $flagCalculate): self
    {
        $this->flagCalculate = $flagCalculate;

        return $this;
    }
}
