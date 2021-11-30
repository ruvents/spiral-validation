<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Annotation\File;

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
    protected const CHECKER = 'file::exists';
}
