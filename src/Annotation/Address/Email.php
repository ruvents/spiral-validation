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
final class Email extends AbstractAnnotation
{
    protected const CHECKER = 'address::email';
}
