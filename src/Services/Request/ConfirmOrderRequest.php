<?php

namespace Malinoff\PlastekBundle\Services\Request;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class ConfirmOrderRequest extends BaseRequest
{
    /**
     * @var string|null
     */
    private $uuidOrder;

    public function getAction(): string
    {
        return sprintf('/api/%s/Shipment/%s/%s/Confirm',
            $this->version,
            $this->uuid,
            $this->ticks
        );
    }

    public function getMethod(): string
    {
        return self::METHOD_POST;
    }

    public function getBody(): array
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

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        parent::loadValidatorMetadata($metadata);

        $metadata->addPropertyConstraint('uuidOrder', new Assert\NotBlank([
            'groups' => ['request'],
        ]));
    }
}
