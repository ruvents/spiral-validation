<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Validation\Checker;

use Spiral\Core\Container\SingletonInterface;
use Spiral\Translator\Traits\TranslatorTrait;
use Spiral\Validation\CheckerInterface;
use Spiral\Validation\ValidatorInterface;

final class CallbackChecker implements SingletonInterface, CheckerInterface
{
    use TranslatorTrait;

    public function check(
        ValidatorInterface $v,
        string $method,
        string $field,
        $value,
        array $args = []
    ): bool {
        return (bool) $method($value, ...$args);
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage(string $method, string $field, $value, array $arguments = []): string
    {
        return $this->say(
            '[[ The value from field "{0}" is not valid. ]]',
            [
                $field,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function ignoreEmpty(string $method, $value, array $args): bool
    {
        return true;
    }
}
