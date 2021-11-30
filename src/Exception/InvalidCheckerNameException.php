<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Exception;

final class InvalidCheckerNameException extends \RuntimeException
{
    public function __construct(string $checkerName)
    {
        $this->message = 'Invalid checker name provided: '.$checkerName;
    }
}
