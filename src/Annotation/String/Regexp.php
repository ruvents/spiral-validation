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
final class Regexp extends AbstractAnnotation
{
    protected const CHECKER = 'string::regexp';
    protected const ARGS = ['expression'];

    /**
     * @Attribute(name="expression", type="string", required=true)
     */
    public string $expression;

    public function __construct(
        string $expression,
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->expression = $expression;
    }
}
