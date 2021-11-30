<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Annotation\Number;

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
final class Range extends AbstractAnnotation
{
    protected const CHECKER = 'number::range';
    protected const ARGS = ['begin', 'end'];

    /**
     * @Attribute(name="begin", type="float", required=true)
     */
    public float $begin;

    /**
     * @Attribute(name="end", type="float", required=true)
     */
    public float $end;

    public function __construct(
        float $begin,
        float $end,
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->begin = $begin;
        $this->end = $end;
    }
}
