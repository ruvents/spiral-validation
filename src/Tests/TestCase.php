<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Tests;

use Ruvents\SpiralValidation\Validation\Checker\CallbackChecker;
use Ruvents\SpiralValidation\Validation\Checker\ObjectChecker;
use Ruvents\SpiralValidation\Validation\ValidationProvider;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Spiral\Attributes\AnnotationReader;
use Spiral\Attributes\AttributeReader;
use Spiral\Attributes\Composite\SelectiveReader;
use Spiral\Attributes\ReaderInterface;
use Spiral\Core\Container;
use Spiral\Files\Files;
use Spiral\Files\FilesInterface;
use Spiral\Validation\Checker\AddressChecker;
use Spiral\Validation\Checker\DatetimeChecker;
use Spiral\Validation\Checker\EntityChecker;
use Spiral\Validation\Checker\FileChecker;
use Spiral\Validation\Checker\ImageChecker;
use Spiral\Validation\Checker\MixedChecker;
use Spiral\Validation\Checker\NumberChecker;
use Spiral\Validation\Checker\StringChecker;
use Spiral\Validation\Checker\TypeChecker;
use Spiral\Validation\Condition;
use Spiral\Validation\Config\ValidatorConfig;

/**
 * @internal
 */
class TestCase extends BaseTestCase
{
    public const CONFIG = [
        'checkers' => [
            'file' => FileChecker::class,
            'image' => ImageChecker::class,
            'type' => TypeChecker::class,
            'address' => AddressChecker::class,
            'string' => StringChecker::class,
            'mixed' => MixedChecker::class,
            'number' => NumberChecker::class,
            'datetime' => DatetimeChecker::class,
            'entity' => EntityChecker::class,
            'object' => ObjectChecker::class,
            'callback' => CallbackChecker::class,
        ],
        'conditions' => [
            'absent' => Condition\AbsentCondition::class,
            'present' => Condition\PresentCondition::class,
            'withAny' => Condition\WithAnyCondition::class,
            'withoutAny' => Condition\WithoutAnyCondition::class,
            'withAll' => Condition\WithAllCondition::class,
            'withoutAll' => Condition\WithoutAllCondition::class,
            'anyOf' => Condition\AnyOfCondition::class,
            'noneOf' => Condition\NoneOfCondition::class,
        ],
    ];

    protected Container $container;

    protected function setUp(): void
    {
        $this->container = new Container();

        // Dependencies.
        $this->container->bind(FilesInterface::class, Files::class);
        $this->container->bind(ValidatorConfig::class, new ValidatorConfig(static::CONFIG));
        $this->container->bind(ReaderInterface::class, new SelectiveReader([
            new AnnotationReader(), new AttributeReader(),
        ]));
    }

    protected function getProvider(): ValidationProvider
    {
        return $this->container->get(ValidationProvider::class);
    }
}
