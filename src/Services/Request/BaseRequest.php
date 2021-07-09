<?php

namespace Malinoff\PlastekBundle\Services\Request;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

abstract class BaseRequest implements RequestInterface
{
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_DELETE = 'DELETE';

    public const TYPE_LOGIN = 'LOGIN';
    public const TYPE_PHONE = 'PHONE';
    public const TYPE_EMAIL = 'EMAIL';
    public const TYPE_CARD_NUMBER = 'CARDNUMBER';

    public const AVAILABLE_LOGIN_TYPES = [
        self::TYPE_LOGIN,
        self::TYPE_PHONE,
        self::TYPE_EMAIL,
        self::TYPE_CARD_NUMBER,
    ];

    protected $version;

    protected $uuid;

    protected $ticks;

    protected $loginType;

    public function setVersion(?string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function setUuid(?string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function setTicks(?string $ticks): self
    {
        $this->ticks = $ticks;

        return $this;
    }

    public function setLoginType(?string $loginType): self
    {
        $this->loginType = $loginType;

        return $this;
    }

    public function getQuery(): array
    {
        return [];
    }

    public function getBody(): array
    {
        return [];
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('version', new Assert\NotBlank([
            'groups' => ['request'],
        ]));
        $metadata->addPropertyConstraint('uuid', new Assert\NotBlank([
            'groups' => ['request'],
        ]));
        $metadata->addPropertyConstraint('ticks', new Assert\NotBlank([
            'groups' => ['request'],
        ]));
        $metadata->addPropertyConstraint('loginType', new Assert\Choice([
            'choices' => self::AVAILABLE_LOGIN_TYPES,
            'groups' => ['request'],
        ]));
    }
}
