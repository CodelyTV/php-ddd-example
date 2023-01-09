<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Domain;

use CodelyTv\Shared\Domain\ValueObject\Enum;
use InvalidArgumentException;

/**
 * @method static LastVideoType screencast()
 * @method static LastVideoType interview()
 */
final class LastVideoType extends Enum
{
    public const SCREENCAST = 'screencast';
    public const INTERVIEW  = 'interview';

    protected function throwExceptionForInvalidValue($value): never
    {
        throw new InvalidArgumentException(sprintf('The <%s> value is not a valid lastVideo type', $value));
    }
}
