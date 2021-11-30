<?php

declare(strict_types=1);

namespace Ruvents\SpiralValidation\Tests\Fixture;

use Ruvents\SpiralValidation\Annotation as Assert;

final class Data
{
    /**
     * @Assert\Type\NotEmpty(asString=true, message="test", conditions={"withAll": {"test"}})
     */
    public $typeNotEmpty;

    /**
     * @Assert\Type\NotNull(message="test", conditions={"withAll": {"test"}})
     */
    public $typeNotNull;

    /**
     * @Assert\Type\Boolean(message="test", conditions={"withAll": {"test"}})
     */
    public $typeBoolean;

    /**
     * @Assert\Address\Email(message="test", conditions={"withAll": {"test"}})
     */
    public $addressEmail;

    /**
     * @Assert\Address\Url(
     *     schemas={"https"},
     *     defaultSchema="https",
     *     message="test",
     *     conditions={"withAll": {"test"}}
     * )
     */
    public $addressUrl;

    /**
     * @Assert\Misc\CardNumber(message="test", conditions={"withAll": {"test"}})
     */
    public $mixedCardNumber;

    /**
     * @Assert\Misc\Matches(field="test", strict=true, message="test", conditions={"withAll": {"test"}})
     */
    public $mixedMatch;

    /**
     * @Assert\Number\Range(begin=0, end=10, message="test", conditions={"withAll": {"test"}})
     */
    public $numberRange;

    /**
     * @Assert\Number\Higher(limit=0, message="test", conditions={"withAll": {"test"}})
     */
    public $numberHigher;

    /**
     * @Assert\Number\Lower(limit=0, message="test", conditions={"withAll": {"test"}})
     */
    public $numberLower;

    /**
     * @Assert\String\Regexp(expression=0, message="test", conditions={"withAll": {"test"}})
     */
    public $stringRegexp;

    /**
     * @Assert\String\Shorter(length=0, message="test", conditions={"withAll": {"test"}})
     */
    public $stringShorter;

    /**
     * @Assert\String\Longer(length=0, message="test", conditions={"withAll": {"test"}})
     */
    public $stringLonger;

    /**
     * @Assert\String\Length(length=0, message="test", conditions={"withAll": {"test"}})
     */
    public $stringLength;

    /**
     * @Assert\String\Range(left=0, right=10, message="test", conditions={"withAll": {"test"}})
     */
    public $stringRange;

    /**
     * @Assert\File\Exists(message="test", conditions={"withAll": {"test"}})
     */
    public $fileExists;

    /**
     * @Assert\File\Uploaded(message="test", conditions={"withAll": {"test"}})
     */
    public $fileUploaded;

    /**
     * @Assert\File\Size(size=0, message="test", conditions={"withAll": {"test"}})
     */
    public $fileSize;

    /**
     * @Assert\File\Extension(extensions={"test"}, message="test", conditions={"withAll": {"test"}})
     */
    public $fileExtension;

    /**
     * @Assert\Image\Type(types={"jpeg", "png"}, message="test", conditions={"withAll": {"test"}})
     */
    public $imageType;

    /**
     * @Assert\Image\Valid(message="test", conditions={"withAll": {"test"}})
     */
    public $imageValid;

    /**
     * @Assert\Image\Smaller(width=128, height=128, message="test", conditions={"withAll": {"test"}})
     */
    public $imageSmaller;

    /**
     * @Assert\Image\Bigger(width=128, height=128, message="test", conditions={"withAll": {"test"}})
     */
    public $imageBigger;

    /**
     * @Assert\Datetime\Past(orNow=true, useMicroSeconds=true, message="test", conditions={"withAll": {"test"}})
     */
    public $datetimePast;

    /**
     * @Assert\Datetime\Future(orNow=true, useMicroSeconds=true, message="test", conditions={"withAll": {"test"}})
     */
    public $datetimeFuture;

    /**
     * @Assert\Datetime\Format(format="H:i", message="test", conditions={"withAll": {"test"}})
     */
    public $datetimeFormat;

    /**
     * @Assert\Datetime\Before(
     *     field="test",
     *     orEquals=true,
     *     useMicroSeconds=true,
     *     message="test",
     *     conditions={"withAll": {"test"}}
     * )
     */
    public $datetimeBefore;

    /**
     * @Assert\Datetime\After(
     *     field="test",
     *     orEquals=true,
     *     useMicroSeconds=true,
     *     message="test",
     *     conditions={"withAll": {"test"}}
     * )
     */
    public $datetimeAfter;

    /**
     * @Assert\Datetime\Valid(message="test", conditions={"withAll": {"test"}})
     */
    public $datetimeValid;

    /**
     * @Assert\Datetime\Timezone(message="test", conditions={"withAll": {"test"}})
     */
    public $datetimeTimezone;

    /**
     * @Assert\Entity\Exists(class="test", field="test", message="test", conditions={"withAll": {"test"}})
     */
    public $entityExists;

    /**
     * @Assert\Entity\Unique(
     *     class="test",
     *     field="test",
     *     withFields={"test"},
     *     message="test",
     *     conditions={"withAll": {"test"}}
     * )
     */
    public $entityUnique;
}
