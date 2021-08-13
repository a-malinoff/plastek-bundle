<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services\Request;

class CreateSimplyLoyaltyMemberRequest extends BaseRequest
{
    /**
     * @var string|null
     */
    private $phoneNumber;

    public function getAction(): string
    {
        return sprintf('/api/%s/UserSimply/%s/%s',
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
            'phoneNumber' => $this->phoneNumber,
        ];
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}
