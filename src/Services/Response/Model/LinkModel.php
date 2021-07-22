<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services\Response\Model;

use JMS\Serializer\Annotation as Serializer;

class LinkModel
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
     * @Serializer\SerializedName("type")
     * @Serializer\Type("string")
     */
    private $type;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("description")
     * @Serializer\Type("string")
     */
    private $description;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("link")
     * @Serializer\Type("string")
     */
    private $link;

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }
}
