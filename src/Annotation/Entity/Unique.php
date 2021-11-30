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
final class Unique extends AbstractAnnotation
{
    protected const CHECKER = 'entity::unique';
    protected const ARGS = ['class', 'field', 'withFields'];

    /**
     * @Attribute(name="class", type="string", required=true)
     */
    public string $class;

    /**
     * @Attribute(name="field", type="string", required=false)
     */
    public ?string $field;

    /**
     * @Attribute(name="withFields", type="array", required=false)
     */
    public array $withFields;

    public function __construct(
        string $class,
        string $field = null,
        array $withFields = [],
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->class = $class;
        $this->field = $field;
        $this->withFields = $withFields;
    }
}
