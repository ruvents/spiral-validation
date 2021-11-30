<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Annotation\Image;

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
final class Type extends AbstractAnnotation
{
    protected const CHECKER = 'image::type';
    protected const ARGS = ['types'];

    /**
     * @Attribute(name="types", type="array", required=true)
     */
    public array $types;

    public function __construct(
        array $types = [],
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->types = $types;
    }
}
