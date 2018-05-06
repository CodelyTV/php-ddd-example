<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\Event;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Event\CourseOpinionCreatedDomainEvent;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionId;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionRating;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionText;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionIdStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionRatingStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionTextStub;

final class CourseOpinionCreatedDomainEventStub
{
    /**
     * @return CourseOpinionCreatedDomainEvent
     *
     * @throws \Exception
     */
    public static function random(): CourseOpinionCreatedDomainEvent
    {
        return self::create(
            CourseIdStub::random(),
            CourseOpinionIdStub::random(),
            CourseOpinionRatingStub::random(),
            CourseOpinionTextStub::random()
        );
    }

    public static function create(
        CourseId $courseId,
        CourseOpinionId $id,
        CourseOpinionRating $rating,
        CourseOpinionText $text
    ): CourseOpinionCreatedDomainEvent {
        return new CourseOpinionCreatedDomainEvent(
            $id->value(),
            [
                'courseId' => $courseId->value(),
                'rating'   => $rating->value(),
                'text'     => $text->value(),
            ]
        );
    }
}
