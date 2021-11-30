<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Annotation\Datetime;

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
final class Format extends AbstractAnnotation
{
    protected const CHECKER = 'datetime::format';
    protected const ARGS = ['format'];

    /**
     * @Attribute(name="format", type="string", required=true)
     */
    public string $format;

    public function __construct(
        string $format,
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->format = $format;
    }
}
