<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Lessons\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

final class LessonEstimatedDurationRecalculatedDomainEvent extends DomainEvent
{
    protected function rules(): array
    {
        return [
            'courseId'             => ['string'],
            'newEstimatedDuration' => ['int'],
        ];
    }

    public static function eventName(): string
    {
        return 'lesson_estimated_duration_recalculated';
    }
}
