<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Application\Create;

use CodelyTv\Context\Course\Module\CourseOpinion\Application\Create\CreateCourseOpinionCommand;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionId;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionRating;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionText;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionIdStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionRatingStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionTextStub;
use CodelyTv\Test\Shared\Domain\UuidStub;
use CodelyTv\Types\ValueObject\Uuid;

final class CreateCourseOpinionCommandStub
{
    /**
     * @return CreateCourseOpinionCommand
     *
     * @throws \Exception
     */
    public static function random(): CreateCourseOpinionCommand
    {
        return self::create(
            new Uuid(UuidStub::random()),
            CourseIdStub::random(),
            CourseOpinionIdStub::random(),
            CourseOpinionRatingStub::random(),
            CourseOpinionTextStub::random()
        );
    }

    public static function create(
        Uuid $requestId,
        CourseId $courseId,
        CourseOpinionId $id,
        CourseOpinionRating $rating,
        CourseOpinionText $text
    ): CreateCourseOpinionCommand {
        return new CreateCourseOpinionCommand(
            $requestId,
            $courseId->value(),
            $id->value(),
            $rating->value(),
            $text->value()
        );
    }

    /**
     * @return CreateCourseOpinionCommand
     *
     * @throws \Exception
     */
    public static function randomWithDecimalRating(): CreateCourseOpinionCommand
    {
        return self::create(
            new Uuid(UuidStub::random()),
            CourseIdStub::random(),
            CourseOpinionIdStub::random(),
            CourseOpinionRatingStub::create(0.5),
            CourseOpinionTextStub::random()
        );
    }

    /**
     * @return CreateCourseOpinionCommand
     *
     * @throws \Exception
     */
    public static function randomWithRatingBelow0(): CreateCourseOpinionCommand
    {
        return self::create(
            new Uuid(UuidStub::random()),
            CourseIdStub::random(),
            CourseOpinionIdStub::random(),
            CourseOpinionRatingStub::create(-1),
            CourseOpinionTextStub::random()
        );
    }

    /**
     * @return CreateCourseOpinionCommand
     *
     * @throws \Exception
     */
    public static function randomWithRatingAbove5(): CreateCourseOpinionCommand
    {
        return self::create(
            new Uuid(UuidStub::random()),
            CourseIdStub::random(),
            CourseOpinionIdStub::random(),
            CourseOpinionRatingStub::create(6),
            CourseOpinionTextStub::random()
        );
    }

    /**
     * @return CreateCourseOpinionCommand
     *
     * @throws \Exception
     */
    public static function randomWithLongerText(): CreateCourseOpinionCommand
    {
        return self::create(
            new Uuid(UuidStub::random()),
            CourseIdStub::random(),
            CourseOpinionIdStub::random(),
            CourseOpinionRatingStub::random(),
            CourseOpinionTextStub::random(301)
        );
    }

    /**
     * @return CreateCourseOpinionCommand
     *
     * @throws \Exception
     */
    public static function randomWithEmptyText(): CreateCourseOpinionCommand
    {
        return self::create(
            new Uuid(UuidStub::random()),
            CourseIdStub::random(),
            CourseOpinionIdStub::random(),
            CourseOpinionRatingStub::random(),
            CourseOpinionTextStub::random(0)
        );
    }
}
