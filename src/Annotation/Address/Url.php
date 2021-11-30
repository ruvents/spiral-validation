<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Annotation\Address;

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
final class Url extends AbstractAnnotation
{
    protected const CHECKER = 'address::url';
    protected const ARGS = ['schemas', 'defaultSchema'];

    /**
     * @Attribute(name="schemas", type="array", required=false)
     */
    public ?array $schemas = null;

    /**
     * @Attribute(name="defaultSchema", type="string", required=false)
     */
    public ?string $defaultSchema = null;

    public function __construct(
        array $schemas = null,
        string $defaultSchema = null,
        string $message = null,
        array $conditions = [],
        string $path = null
    ) {
        parent::__construct($message, $conditions, $path);

        $this->schemas = $schemas;
        $this->defaultSchema = $defaultSchema;
    }
}
