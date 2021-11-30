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
final class Range extends AbstractAnnotation
{
    protected const CHECKER = 'string::range';
    protected const ARGS = ['left', 'right'];

    /**
     * @Attribute(name="left", type="int", required=true)
     */
    public int $left;

    /**
     * @Attribute(name="right", type="int", required=true)
     */
    public int $right;

    public function __construct(
        int $left,
        int $right,
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->left = $left;
        $this->right = $right;
    }
}
