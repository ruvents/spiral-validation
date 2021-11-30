<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Annotation\Misc;

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
final class Matches extends AbstractAnnotation
{
    protected const CHECKER = 'mixed::match';
    protected const ARGS = ['field', 'strict'];

    /**
     * @Attribute(name="field", type="string", required=true)
     */
    public string $field;

    /**
     * @Attribute(name="strict", type="bool", required=false)
     */
    public bool $strict;

    public function __construct(
        string $field,
        bool $strict = false,
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->field = $field;
        $this->strict = $strict;
    }
}
