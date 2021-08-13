<?php

declare(strict_types=1);

namespace Malinoff\PlastekBundle\Tests\mocks;

use Psr\Log\LoggerInterface;

class MockLogger implements LoggerInterface
{
    /**
     * {@inheritDoc}
     */
    public function emergency($message, array $context = [])
    {
    }

    /**
     * {@inheritDoc}
     */
    public function alert($message, array $context = [])
    {
    }

    /**
     * {@inheritDoc}
     */
    public function critical($message, array $context = [])
    {
    }

    /**
     * {@inheritDoc}
     */
    public function error($message, array $context = [])
    {
    }

    /**
     * {@inheritDoc}
     */
    public function warning($message, array $context = [])
    {
    }

    /**
     * {@inheritDoc}
     */
    public function notice($message, array $context = [])
    {
    }

    /**
     * {@inheritDoc}
     */
    public function info($message, array $context = [])
    {
    }

    /**
     * {@inheritDoc}
     */
    public function debug($message, array $context = [])
    {
    }

    /**
     * {@inheritDoc}
     */
    public function log($level, $message, array $context = [])
    {
    }
}
