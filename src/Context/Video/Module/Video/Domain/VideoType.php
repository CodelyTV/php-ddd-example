<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Domain;

use CodelyTv\Types\ValueObject\Enum;
use InvalidArgumentException;

/**
 * @method static VideoType screencast()
 * @method static VideoType interview()
 */
final class VideoType extends Enum
{
    const SCREENCAST = 'screencast';
    const INTERVIEW  = 'interview';

    protected function throwExceptionForInvalidValue($value)
    {
        throw new InvalidArgumentException(sprintf('The <%s> value is not a valid video type', $value));
    }
}
