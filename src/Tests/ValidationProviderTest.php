<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Tests;

use Ruvents\SpiralValidation\Annotation\AbstractAnnotation;
use Ruvents\SpiralValidation\Annotation as Assert;
use Ruvents\SpiralValidation\Tests\Fixture\AttributesData;
use Ruvents\SpiralValidation\Tests\Fixture\ChildData;
use Ruvents\SpiralValidation\Tests\Fixture\Data;
use Spiral\Validation\Checker\MixedChecker;
use Spiral\Validation\CheckerRule;
use Spiral\Validation\Condition\WithAnyCondition;

/**
 * @internal
 */
final class ValidationProviderTest extends TestCase
{
    public function testAnnotationsExtraction(): void
    {
        $provider = $this->getProvider();

        $properties = $provider->getAnnotations(Data::class);
        $this->assertCount(32, $properties);

        foreach ($properties as $annotations) {
            $this->assertContainsOnlyInstancesOf(AbstractAnnotation::class, $annotations);
        }
    }

    public function testAttributesExtraction(): void
    {
        $provider = $this->getProvider();

        $properties = $provider->getAnnotations(AttributesData::class);
        $this->assertCount(32, $properties);

        foreach ($properties as $annotations) {
            $this->assertContainsOnlyInstancesOf(AbstractAnnotation::class, $annotations);
        }
    }

    public function testValidation(): void
    {
        $provider = $this->getProvider();

        $this->assertTrue($provider->validate(
            new class() {
                /**
                 * @Assert\String\Longer(2)
                 */
                public string $valid = 'valid';
            }
        )->isValid());

        $validator = $provider->validate(
            new class() {
                /**
                 * @Assert\String\Shorter(2)
                 */
                public string $invalid = 'invalid';
            }
        );

        $this->assertFalse($validator->isValid());
        $this->assertIsArray($validator->getErrors());
        $this->assertCount(1, $validator->getErrors());
    }

    public function testNestedRulesExtraction(): void
    {
        $provider = $this->getProvider();

        $properties = $provider->getAnnotations(new ChildData());

        $this->assertCount(2, $properties);

        foreach ($properties as $annotations) {
            $rules = iterator_to_array($provider->getRules($annotations));

            $this->assertCount(1, $rules);
            $this->assertContainsOnlyInstancesOf(CheckerRule::class, $rules);
        }
    }

    public function testRulesExtraction(): void
    {
        $provider = $this->getProvider();

        $properties = $provider->getAnnotations(
            new class() {
                /**
                 * @Assert\Type\NotEmpty()
                 * @Assert\String\Longer(2)
                 */
                public string $notEmpty = 'test';
            }
        );

        foreach ($properties as $annotations) {
            $rules = iterator_to_array($provider->getRules($annotations));

            $this->assertCount(2, $rules);
            $this->assertContainsOnlyInstancesOf(CheckerRule::class, $rules);
        }
    }

    public function testRuleCreation(): void
    {
        $annotation = new Assert\Misc\Matches('field');

        $annotation->strict = true;
        $annotation->message = $message = 'Test message';
        $annotation->conditions = ['withAny' => ['test']];

        $rule = $this->getProvider()->makeRule($annotation);

        $class = new \ReflectionClass($rule);

        $property = $class->getProperty('checker');
        $property->setAccessible(true);
        $this->assertInstanceOf(MixedChecker::class, $property->getValue($rule));

        $property = $class->getProperty('method');
        $property->setAccessible(true);
        $this->assertSame('match', $property->getValue($rule));

        $property = $class->getProperty('args');
        $property->setAccessible(true);
        $this->assertSame(['field', true], $property->getValue($rule));

        $property = $class->getProperty('message');
        $property->setAccessible(true);
        $this->assertSame($message, $property->getValue($rule));

        $conditions = iterator_to_array($rule->getConditions());
        $this->assertCount(1, $conditions);

        $condition = reset($conditions);

        $this->assertInstanceOf(WithAnyCondition::class, $condition);
    }
}
