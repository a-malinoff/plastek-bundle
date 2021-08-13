<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services\Request;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class CancelOrderRequest extends BaseRequest
{
    /**
     * @var string|null
     */
    private $uuidOrder;

    public function getAction(): string
    {
        return sprintf('/api/%s/Shipment/%s/%s',
            $this->version,
            $this->uuid,
            $this->ticks
        );
    }

    public function getMethod(): string
    {
        return self::METHOD_DELETE;
    }

    public function getQuery(): array
    {
        return [
            'uuidOrder' => $this->uuidOrder,
        ];
    }

    public function setUuidOrder(?string $uuidOrder): self
    {
        $this->uuidOrder = $uuidOrder;

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        parent::loadValidatorMetadata($metadata);

        $metadata->addPropertyConstraint('uuidOrder', new Assert\NotBlank([
            'groups' => ['request'],
        ]));
    }
}
