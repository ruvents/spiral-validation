<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Annotation\Entity;

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
final class Exists extends AbstractAnnotation
{
    protected const CHECKER = 'entity::exists';
    protected const ARGS = ['class', 'field'];

    /**
     * @Attribute(name="class", type="string", required=true)
     */
    public string $class;

    /**
     * @Attribute(name="field", type="string", required=false)
     */
    public ?string $field;

    public function __construct(
        string $class,
        string $field = null,
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->class = $class;
        $this->field = $field;
    }
}
