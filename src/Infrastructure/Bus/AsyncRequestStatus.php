<?php

declare (strict_types = 1);

namespace CodelyTv\Infrastructure\Bus;

use CodelyTv\Types\ValueObject\Enum;

/**
 * @method static AsyncRequestStatus ok()
 * @method static AsyncRequestStatus ko()
 * @method static AsyncRequestStatus pending()
 * @method static AsyncRequestStatus inProgress()
 */
final class AsyncRequestStatus extends Enum
{
    private const OK          = 'ok';
    private const KO          = 'ko';
    private const PENDING     = 'pending';
    private const IN_PROGRESS = 'in_progress';

    protected function throwExceptionForInvalidValue($value)
    {
        throw new \InvalidArgumentException(sprintf('The value <%s> is an invalid async request status', $value));
    }
}
