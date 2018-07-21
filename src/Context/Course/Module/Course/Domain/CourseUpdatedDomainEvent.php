<?php

namespace CodelyTv\Context\Course\Module\Course\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

final class CourseUpdatedDomainEvent extends DomainEvent
{
    public static function eventName(): string
    {
        return 'course_updated';
    }

    protected function rules(): array
    {
        return [
            'title'       => ['string'],
            'description' => ['string'],
        ];
    }
}
