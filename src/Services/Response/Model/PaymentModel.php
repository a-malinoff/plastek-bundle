<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services\Response\Model;

use JMS\Serializer\Annotation as Serializer;

class PaymentModel
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
     * @Serializer\SerializedName("currencyCodeType")
     * @Serializer\Type("string")
     */
    private $currencyCodeType;

    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("currencyType")
     * @Serializer\Type("string")
     */
    private $currencyType;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("balance")
     * @Serializer\Type("float")
     */
    private $balance;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("cashBalance")
     * @Serializer\Type("float")
     */
    private $cashBalance;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("activeBalance")
     * @Serializer\Type("float")
     */
    private $activeBalance;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("activeCashBalance")
     * @Serializer\Type("float")
     */
    private $activeCashBalance;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("pendingBalance")
     * @Serializer\Type("float")
     */
    private $pendingBalance;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("pendingCashBalance")
     * @Serializer\Type("float")
     */
    private $pendingCashBalance;

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

    public function getCurrencyCodeType(): ?string
    {
        return $this->currencyCodeType;
    }

    public function getCurrencyType(): ?string
    {
        return $this->currencyType;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function getCashBalance(): ?float
    {
        return $this->cashBalance;
    }

    public function getActiveBalance(): ?float
    {
        return $this->activeBalance;
    }

    public function getActiveCashBalance(): ?float
    {
        return $this->activeCashBalance;
    }

    public function getPendingBalance(): ?float
    {
        return $this->pendingBalance;
    }

    public function getPendingCashBalance(): ?float
    {
        return $this->pendingCashBalance;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
