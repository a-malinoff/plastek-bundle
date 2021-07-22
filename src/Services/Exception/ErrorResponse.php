<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Services\Exception;

class ErrorResponse
{
    public const ERROR_LEVEL_SYSTEM_1 = 1; //1 уровень системной ошибки
    public const ERROR_LEVEL_SYSTEM_2 = 2; //2 уровень системной ошибки
    public const ERROR_LEVEL_SYSTEM_3 = 3; //3 уровень системной ошибки
    public const ERROR_LEVEL_LOGIC = 4; //уровень ошибки бизнес логики процесса
    public const ERROR_LEVEL_VIEW = 5; //уровень ошибки, которую можно выводить пользователю

    /**
     * @var int|null
     */
    private $errorLevel;

    /**
     * @var int|null
     */
    private $idError;

    /**
     * @var string|null
     */
    private $text;

    public function getErrorLevel(): ?int
    {
        return $this->errorLevel;
    }

    public function setErrorLevel(?int $errorLevel): self
    {
        $this->errorLevel = $errorLevel;

        return $this;
    }

    public function getIdError(): ?int
    {
        return $this->idError;
    }

    public function setIdError(?int $idError): self
    {
        $this->idError = $idError;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
