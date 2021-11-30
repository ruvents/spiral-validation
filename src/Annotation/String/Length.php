<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Annotation\String;

use Ruvents\SpiralValidation\Annotation\AbstractAnnotation;
use Attribute;
use Doctrine\Common\Annotations\Annotation\NamedArgumentConstructor;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation()
 * @NamedArgumentConstructor()
 * @Target({"PROPERTY"})
 */
#[Attribute]
final class Length extends AbstractAnnotation
{
    protected const CHECKER = 'string::length';
    protected const ARGS = ['length'];

    /**
     * @Attribute(name="length", type="int", required=true)
     */
    public int $length;

    public function __construct(
        int $length,
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->length = $length;
    }
}
