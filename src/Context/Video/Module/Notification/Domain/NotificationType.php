<?php

namespace CodelyTv\Context\Video\Module\Notification\Domain;

use CodelyTv\Types\ValueObject\Enum;
use InvalidArgumentException;

/**
 * @method static NotificationType videoCreated()
 */
final class NotificationType extends Enum
{
    const VIDEO_CREATED = 'VideoCreated';

    protected function throwExceptionForInvalidValue($value)
    {
        throw new InvalidArgumentException(sprintf('The <%s> is not a valid notification type', $value));
    }
}
