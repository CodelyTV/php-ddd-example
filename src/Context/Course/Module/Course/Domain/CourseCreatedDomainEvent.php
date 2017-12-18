<?php

namespace CodelyTv\Context\Course\Module\Course\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

/**
 * CourseCreatedDomainEvent
 */
class CourseCreatedDomainEvent extends DomainEvent
{

    public static function eventName(): string
    {
        return 'course_created';
    }

    protected function rules(): array
    {
        return [
            'title' => ['string'],
            'description' => ['string'],
        ];
    }
}