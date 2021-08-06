<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests\mocks;

use JMS\Serializer\Annotation as Serializer;
use Malinoff\PlastekBundle\Services\Response\ResponseInterface;

class TestResponse implements ResponseInterface
{
    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("fieldOne")
     * @Serializer\Type("string")
     */
    public $fieldOne;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("fieldTwo")
     * @Serializer\Type("string")
     */
    public $fieldTwo;

    /**
     * @var float|null
     *
     * @Serializer\Groups({"response"})
     * @Serializer\SerializedName("fieldThree")
     * @Serializer\Type("string")
     */
    public $fieldThree;
}
