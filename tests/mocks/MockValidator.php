<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests\mocks;

use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MockValidator implements ValidatorInterface
{
    /**
     * {@inheritDoc}
     */
    public function getMetadataFor($value)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function hasMetadataFor($value)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function validate($value, $constraints = null, $groups = null)
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function validateProperty($object, string $propertyName, $groups = null)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function validatePropertyValue($objectOrClass, string $propertyName, $value, $groups = null)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function startContext()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function inContext(ExecutionContextInterface $context)
    {
    }
}
