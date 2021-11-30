<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Validation\Checker;

use Ruvents\SpiralValidation\Validation\ValidationProvider;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Translator\Traits\TranslatorTrait;
use Spiral\Validation\CheckerInterface;
use Spiral\Validation\ValidatorInterface;

final class ObjectChecker implements SingletonInterface, CheckerInterface
{
    use TranslatorTrait;

    private ?ValidatorInterface $validator;

    private ValidationProvider $validation;

    public function __construct(ValidationProvider $validation)
    {
        $this->validation = $validation;
    }

    /**
     * {@inheritdoc}
     */
    public function ignoreEmpty(string $method, $value, array $args): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function check(
        ValidatorInterface $v,
        string $method,
        string $field,
        $value,
        array $args = []
    ): bool {
        return $this->validation->validate($value)->isValid();
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage(string $method, string $field, $value, array $arguments = []): string
    {
        return $this->say(
            '[[ Object "{0}" from field "{1}" is not valid. ]]',
            [
                \get_class($value),
                $field,
            ]
        );
    }
}
