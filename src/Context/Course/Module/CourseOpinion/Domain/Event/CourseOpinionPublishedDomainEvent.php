<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Domain\Event;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

/**
 * @method string courseId()
 * @method int    rating()
 * @method string text()
 */
final class CourseOpinionPublishedDomainEvent extends DomainEvent
{
    public static function eventName(): string
    {
        return 'course_opinion_published';
    }

    protected function rules(): array
    {
        return [
            'courseId' => ['string'],
            'rating'   => ['int'],
            'text'     => ['string'],
        ];
    }
}
