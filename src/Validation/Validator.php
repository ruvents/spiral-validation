<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Validation;

use Ruvents\SpiralPropertyAccessor\PropertyAccessor;
use Spiral\Validation\AbstractValidator;
use Spiral\Validation\RulesInterface;
use Spiral\Validation\ValidatorInterface;

final class Validator extends AbstractValidator
{
    private array|object $data;

    private PropertyAccessor $accessor;

    private ?array $mappedErrors = null;

    public function __construct(
        array|object $data,
        array $rules,
        RulesInterface $ruleProvider,
        mixed $context = null
    ) {
        parent::__construct($this->flattenRules($rules), $context, $ruleProvider);

        $this->data = $data;
        $this->accessor = new PropertyAccessor();
    }

    public function __destruct()
    {
        parent::__destruct();

        $this->mappedErrors = null;
    }

    public function __clone()
    {
        parent::__clone();

        $this->mappedErrors = null;
    }

    /**
     * {@inheritdoc}
     */
    public function withData($data): ValidatorInterface
    {
        $validator = clone $this;
        $validator->data = $data;

        return $validator;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(string $field, $default = null)
    {
        return $this->accessor->get($this->data, $field, $default);
    }

    /**
     * {@inheritdoc}
     */
    public function hasValue(string $field): bool
    {
        return $this->accessor->has($this->data, $field);
    }

    /**
     * {@inheritdoc}
     */
    public function getErrors(): array
    {
        return $this->mapErrors(parent::getErrors());
    }

    /**
     * {@inheritdoc}
     */
    public function hasError(string $field): bool
    {
        return $this->accessor->has($this->getErrors(), $field);
    }

    private function flattenRules(array $rules): array
    {
        $result = [];

        foreach ($rules as $rulePrefix => $rulesList) {
            foreach ($rulesList as $rule) {
                $key = implode('.', array_filter([$rulePrefix, $rule->path ?? '']));

                if (false === isset($result[$key])) {
                    $result[$key] = [];
                } elseif (false === \is_array($result[$key])) {
                    continue;
                }

                $result[$key][] = $rule;
            }
        }

        return $result;
    }

    private function mapErrors(array $errors): array
    {
        if (null !== $this->mappedErrors) {
            return $this->mappedErrors;
        }

        $mappedErrors = [];

        foreach ($errors as $name => $error) {
            $this->accessor->set($mappedErrors, $name, $errors[$name]);
        }

        return $this->mappedErrors = $mappedErrors;
    }
}
