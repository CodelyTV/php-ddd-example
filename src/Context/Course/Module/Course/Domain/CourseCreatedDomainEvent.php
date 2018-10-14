<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Course\Module\Course\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

final class CourseCreatedDomainEvent extends DomainEvent
{
    public static function eventName(): string
    {
        return 'course_created';
    }

    protected function rules(): array
    {
        return [
            'title'       => ['string'],
            'description' => ['string'],
        ];
    }
}
