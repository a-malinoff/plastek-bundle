<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services\Response;

use DateTime;
use JMS\Serializer\Annotation as Serializer;

class CancelOrderResponse implements ResponseInterface
{
    /**
     * @var string|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("uuidTransaction")
     * @Serializer\Type("string")
     */
    private $uuidTransaction;

    /**
     * @var DateTime|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("transactionUtc")
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s'>")
     */
    private $transactionUtc;

    public function getUuidTransaction(): ?string
    {
        return $this->uuidTransaction;
    }

    public function getTransactionUtc(): ?DateTime
    {
        return $this->transactionUtc;
    }
}
