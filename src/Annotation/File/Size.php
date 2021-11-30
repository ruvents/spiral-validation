<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Annotation\File;

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
final class Size extends AbstractAnnotation
{
    protected const CHECKER = 'file::size';
    protected const ARGS = ['size'];

    /**
     * @Attribute(name="size", type="int", required=true)
     */
    public int $size;

    public function __construct(
        int $size,
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->size = $size;
    }
}
