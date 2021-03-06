<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services\Exception;

use Exception;

class PlastekException extends Exception
{
    /**
     * @var ErrorResponse
     */
    private $errorResponse;

    public function __construct(
        Exception $previous = null,
        ErrorResponse $errorResponse = null
    ) {
        parent::__construct($previous->getMessage(), $previous->getCode(), $previous->getPrevious());

        $this->errorResponse = $errorResponse;
    }

    public function getErrorResponse(): ErrorResponse
    {
        return $this->errorResponse;
    }
}
