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
final class After extends AbstractAnnotation
{
    protected const CHECKER = 'datetime::after';
    protected const ARGS = ['field', 'orEquals', 'useMicroSeconds'];

    /**
     * @Attribute(name="field", type="string", required=true)
     */
    public string $field;

    /**
     * @Attribute(name="orEquals", type="bool", required=false)
     */
    public bool $orEquals;

    /**
     * @Attribute(name="useMicroSeconds", type="bool", required=false)
     */
    public bool $useMicroSeconds;

    public function __construct(
        string $field,
        bool $orEquals = false,
        bool $useMicroSeconds = false,
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->field = $field;
        $this->orEquals = $orEquals;
        $this->useMicroSeconds = $useMicroSeconds;
    }
}
