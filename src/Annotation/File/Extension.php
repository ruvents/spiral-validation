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
final class Extension extends AbstractAnnotation
{
    protected const CHECKER = 'file::extension';
    protected const ARGS = ['extensions'];

    /**
     * @Attribute(name="extensions", type="array", required=true)
     */
    public array $extensions;

    public function __construct(
        array $extensions = [],
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->extensions = $extensions;
    }
}
