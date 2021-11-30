<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Annotation\Type;

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
final class NotEmpty extends AbstractAnnotation
{
    protected const CHECKER = 'type::notEmpty';
    protected const ARGS = ['asString'];

    /**
     * @Attribute(name="asString", type="bool", required=false)
     */
    public bool $asString;

    public function __construct(
        bool $asString = true,
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->asString = $asString;
    }
}
