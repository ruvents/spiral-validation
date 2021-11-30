<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Tests;

use Ruvents\SpiralValidation\Annotation as Assert;

/**
 * @internal
 */
final class ValidatorTest extends TestCase
{
    public function testErrorsMapping(): void
    {
        $provider = $this->getProvider();

        $validator = $provider->validate(
            new class() {
                /**
                 * @Assert\Type\NotNull(message="Oh no", path="some.deep.path")
                 */
                public array $foo = [
                    'some' => [
                        'deep' => [
                            'path' => null,
                        ],
                    ],
                ];

                /**
                 * @Assert\Type\NotNull(message="Oh no")
                 */
                public ?string $bar = null;
            }
        );

        $this->assertFalse($validator->isValid());
        $this->assertSame(
            [
                'foo' => [
                    'some' => [
                        'deep' => [
                            'path' => 'Oh no',
                        ],
                    ],
                ],
                'bar' => 'Oh no',
            ],
            $validator->getErrors(),
        );
        $this->assertTrue($validator->hasError('foo.some.deep.path'));
        $this->assertTrue($validator->hasError('bar'));
    }
}
