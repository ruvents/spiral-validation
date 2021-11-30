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
final class Valid extends AbstractAnnotation
{
    protected const CHECKER = 'datetime::valid';
}
