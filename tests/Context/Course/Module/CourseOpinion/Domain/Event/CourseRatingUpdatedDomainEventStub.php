<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\Event;

use CodelyTv\Context\Course\Module\Course\Domain\Event\CourseRatingUpdatedDomainEvent;
use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseDescription;
use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseRating;
use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseTitle;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseDescriptionStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseRatingStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseTitleStub;

final class CourseRatingUpdatedDomainEventStub
{
    /**
     * @return CourseRatingUpdatedDomainEvent
     *
     * @throws \Exception
     */
    public static function random(): CourseRatingUpdatedDomainEvent
    {
        return self::create(
            CourseIdStub::random(),
            CourseTitleStub::random(),
            CourseDescriptionStub::random(),
            CourseRatingStub::random()
        );
    }

    public static function create(
        CourseId $id,
        CourseTitle $title,
        CourseDescription $description,
        CourseRating $rating
    ): CourseRatingUpdatedDomainEvent {
        return new CourseRatingUpdatedDomainEvent(
            $id->value(),
            [
                'title'       => $title->value(),
                'description' => $description->value(),
                'rating'      => $rating->value(),
            ]
        );
    }
}
