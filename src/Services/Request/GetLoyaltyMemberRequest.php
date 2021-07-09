<?php

namespace Malinoff\PlastekBundle\Services\Request;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class GetLoyaltyMemberRequest extends BaseRequest
{
    /**
     * @var string|null
     */
    private $userLogin;

    public function getAction(): string
    {
        return sprintf('/api/%s/User/%s/%s/%s',
            $this->version,
            $this->uuid,
            $this->ticks,
            $this->loginType
        );
    }

    public function getMethod(): string
    {
        return self::METHOD_GET;
    }

    public function getQuery(): array
    {
        return [
            'userLogin' => $this->userLogin,
        ];
    }

    public function setUserLogin(?string $userLogin): self
    {
        $this->userLogin = $userLogin;

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        parent::loadValidatorMetadata($metadata);

        $metadata->addPropertyConstraint('userLogin', new Assert\NotBlank([
            'groups' => ['request'],
        ]));
    }
}
