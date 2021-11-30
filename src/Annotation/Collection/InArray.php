<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Annotation\Collection;

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
final class InArray extends AbstractAnnotation
{
    protected const CHECKER = 'in_array';
    protected const ARGS = ['list'];

    /**
     * @Attribute(name="list", type="array", required=true)
     */
    public array $list;

    public function __construct(
        array $list,
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->list = $list;
    }
}
