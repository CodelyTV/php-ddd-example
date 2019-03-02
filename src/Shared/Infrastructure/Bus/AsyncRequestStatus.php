<?php

declare (strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Bus;

use CodelyTv\Shared\Domain\ValueObject\Enum;

/**
 * @method static AsyncRequestStatus ok()
 * @method static AsyncRequestStatus ko()
 * @method static AsyncRequestStatus pending()
 * @method static AsyncRequestStatus inProgress()
 */
final class AsyncRequestStatus extends Enum
{
    public const OK          = 'ok';
    public const KO          = 'ko';
    public const PENDING     = 'pending';
    public const IN_PROGRESS = 'in_progress';

    protected function throwExceptionForInvalidValue($value): void
    {
        throw new \InvalidArgumentException(sprintf('The value <%s> is an invalid async request status', $value));
    }
}
