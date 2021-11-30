<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Tests\Fixture;

use Ruvents\SpiralValidation\Annotation as Assert;

final class ChildData extends ParentData
{
    /**
     * @Assert\Type\NotEmpty()
     */
    public $childProperty;
}
