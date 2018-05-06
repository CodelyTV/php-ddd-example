<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\Course\Domain\Event;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

final class CourseRatingUpdatedDomainEvent extends DomainEvent
{
    public static function eventName(): string
    {
        return 'course_rating_updated';
    }

    protected function rules(): array
    {
        return [
            'title'       => ['string'],
            'description' => ['string'],
            'rating'      => ['int'],
        ];
    }
}
