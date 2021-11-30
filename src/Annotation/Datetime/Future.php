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
final class Future extends AbstractAnnotation
{
    protected const CHECKER = 'datetime::future';
    protected const ARGS = ['orNow', 'useMicroSeconds'];

    /**
     * @Attribute(name="orNow", type="bool", required=false)
     */
    public bool $orNow;

    /**
     * @Attribute(name="useMicroSeconds", type="bool, required=false")
     */
    public bool $useMicroSeconds;

    public function __construct(
        bool $orNow = false,
        bool $useMicroSeconds = false,
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->orNow = $orNow;
        $this->useMicroSeconds = $useMicroSeconds;
    }
}
