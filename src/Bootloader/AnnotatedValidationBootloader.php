<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Bootloader;

use Ruvents\SpiralValidation\Validation\Checker\CallbackChecker;
use Ruvents\SpiralValidation\Validation\Checker\ObjectChecker;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Bootloader\Security\ValidationBootloader;

final class AnnotatedValidationBootloader extends Bootloader
{
    protected const DEPENDENCIES = [
        ValidationBootloader::class,
    ];

    public function boot(ValidationBootloader $validation): void
    {
        $validation->addChecker('object', ObjectChecker::class);
        $validation->addChecker('callback', CallbackChecker::class);
    }
}
