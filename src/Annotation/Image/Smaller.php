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
final class Smaller extends AbstractAnnotation
{
    protected const CHECKER = 'image::smaller';
    protected const ARGS = ['width', 'height'];

    /**
     * @Attribute(name="width", type="int", required=true)
     */
    public int $width;

    /**
     * @Attribute(name="width", type="int", required=true)
     */
    public int $height;

    public function __construct(
        int $width,
        int $height,
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->width = $width;
        $this->height = $height;
    }
}
