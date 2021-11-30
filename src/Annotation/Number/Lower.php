<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Annotation\Number;

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
final class Lower extends AbstractAnnotation
{
    protected const CHECKER = 'number::lower';
    protected const ARGS = ['limit'];

    /**
     * @Attribute(name="limit", type="float", required=true)
     */
    public float $limit;

    public function __construct(
        float $limit,
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->limit = $limit;
    }
}
