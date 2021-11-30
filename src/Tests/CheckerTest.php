<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Tests;

use Ruvents\SpiralValidation\Annotation as Assert;

/**
 * @internal
 */
final class CheckerTest extends TestCase
{
    public function testIsValidChecker(): void
    {
        $validator = $this->getProvider()->validate(new class() {
            /**
             * @Assert\Object\IsValid()
             */
            public object $validObject;

            public function __construct()
            {
                $this->validObject = new class() {
                    /**
                     * @Assert\Type\NotEmpty()
                     */
                    public string $validString = 'valid!';
                };
            }
        });

        $this->assertTrue($validator->isValid());

        $validator = $this->getProvider()->validate(new class() {
            /**
             * @Assert\Object\IsValid()
             */
            public object $validObject;

            public function __construct()
            {
                $this->validObject = new class() {
                    /**
                     * @Assert\Type\NotEmpty()
                     */
                    public string $invalidString = '';
                };
            }
        });

        $this->assertFalse($validator->isValid());
        $this->assertCount(1, $validator->getErrors());
    }

    public function testInArray(): void
    {
        $validator = $this->getProvider()->validate(new class() {
            /**
             * @Assert\Collection\InArray({"bar"})
             */
            public string $foo = 'bar';
        });

        $this->assertTrue($validator->isValid());

        $validator = $this->getProvider()->validate(new class() {
            /**
             * @Assert\Collection\InArray({"bar"})
             */
            public string $foo = 'test';
        });

        $this->assertFalse($validator->isValid());
        $this->assertCount(1, $validator->getErrors());
    }
}
