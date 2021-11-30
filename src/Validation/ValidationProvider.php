<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Validation;

use Ruvents\SpiralValidation\Annotation\AbstractAnnotation;
use Ruvents\SpiralValidation\Exception\InvalidCheckerNameException;
use Spiral\Attributes\ReaderInterface;
use Spiral\Core\Container\Autowire;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Core\FactoryInterface;
use Spiral\Validation\CheckerRule;
use Spiral\Validation\Config\ValidatorConfig;
use Spiral\Validation\RuleInterface;
use Spiral\Validation\RulesInterface;
use Spiral\Validation\ValidatorInterface;

final class ValidationProvider implements RulesInterface, SingletonInterface
{
    private ValidatorConfig $config;

    private FactoryInterface $factory;

    private ReaderInterface $reader;

    private array $reflectionsCache = [];

    public function __construct(
        ValidatorConfig $config,
        FactoryInterface $factory,
        ReaderInterface $reader
    ) {
        $this->config = $config;
        $this->factory = $factory;
        $this->reader = $reader;
    }

    public function validate(object $data, array $context = null): ValidatorInterface
    {
        return new Validator($data, $this->getAnnotations($data), $this, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function getRules($rules): \Generator
    {
        if (false === \is_array($rules)) {
            return;
        }

        foreach ($rules as $annotation) {
            if (false === $annotation instanceof AbstractAnnotation) {
                continue;
            }

            yield $this->makeRule($annotation);
        }
    }

    /**
     * @param object|class-string $class
     */
    public function getAnnotations($class): array
    {
        $class = \is_object($class) ? \get_class($class) : $class;

        if (isset($this->reflectionsCache[$class])) {
            return $this->reflectionsCache[$class];
        }

        return $this->reflectionsCache[$class] = array_reduce(
            (new \ReflectionClass($class))->getProperties(),
            function (array $carry, \ReflectionProperty $item): array {
                $carry[$item->getName()] = array_filter(
                    $this->iterableToArray($this->reader->getPropertyMetadata($item)),
                    static function ($annotation) {
                        return is_a($annotation, AbstractAnnotation::class);
                    }
                );

                return $carry;
            },
            []
        );
    }

    public function makeRule(AbstractAnnotation $annotation): RuleInterface
    {
        $components = explode('::', $annotation->getChecker());

        if (2 === \count($components)) {
            [$checkerName, $method] = $components;
        } elseif (1 === \count($components)) {
            [$checkerName, $method] = ['callback', reset($components)];
        } else {
            throw new InvalidCheckerNameException($annotation->getChecker());
        }

        if (false === $this->config->hasChecker($checkerName)) {
            throw new InvalidCheckerNameException($checkerName);
        }

        $checker = $this->config->getChecker($checkerName)->resolve($this->factory);

        return (new CheckerRule(
            $checker,
            $method,
            $annotation->getArguments(),
            $annotation->getMessage()
        ))->withConditions($this->makeConditions($annotation->conditions));
    }

    private function makeConditions(array $conditions): ?\SplObjectStorage
    {
        if (empty($conditions)) {
            return null;
        }

        $storage = new \SplObjectStorage();

        foreach ($conditions as $condition => $options) {
            $condition = $this->config->resolveAlias($condition);

            if ($this->config->hasCondition($condition)) {
                $autowire = $this->config->getCondition($condition);
            } else {
                $autowire = new Autowire($condition);
            }

            $storage->attach($autowire->resolve($this->factory), $options);
        }

        return $storage;
    }

    private function iterableToArray(iterable $input): array
    {
        if (\is_array($input)) {
            return $input;
        }

        return iterator_to_array($input);
    }
}
