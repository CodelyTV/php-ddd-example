<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Lessons\Application\RecalculateEstimatedDuration;

use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class RecalculateLessonEstimatedDurationOnStepCreated implements DomainEventSubscriber
{
    public static function subscribedTo(): array
    {
        return [];
    }
}
