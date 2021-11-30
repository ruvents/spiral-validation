<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Annotation;

use Doctrine\Common\Annotations\NamedArgumentConstructorAnnotation;

abstract class AbstractAnnotation implements NamedArgumentConstructorAnnotation
{
    /**
     * Path to checker method. Example: type::notEmpty.
     */
    protected const CHECKER = '';

    /**
     * Must be in the same order as arguments of checker.
     */
    protected const ARGS = [];

    /**
     * @Attribute(name="message", type="string", required=false)
     */
    public ?string $message;

    /**
     * TODO: переименовать в if.
     *
     * @Attribute(name="conditions", type="array", required=false)
     */
    public array $conditions;

    /**
     * @Attribute(name="path", type="string", required=false)
     */
    public ?string $path;

    public function __construct(
        ?string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        $this->message = $message;
        $this->conditions = $conditions;
        $this->path = $path;
    }

    public function getChecker(): string
    {
        return static::CHECKER;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getArguments(): array
    {
        return array_map(function (string $name): mixed {
            return $this->{$name};
        }, static::ARGS);
    }

    public function getConditions(): array
    {
        return $this->conditions;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }
}
