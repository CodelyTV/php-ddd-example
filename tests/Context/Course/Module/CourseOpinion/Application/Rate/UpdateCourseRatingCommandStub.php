<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Application\Rate;

use CodelyTv\Context\Course\Module\CourseOpinion\Application\Rate\UpdateCourseRatingCommand;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdStub;
use CodelyTv\Test\Shared\Domain\UuidStub;
use CodelyTv\Types\ValueObject\Uuid;

final class UpdateCourseRatingCommandStub
{
    public static function random(): UpdateCourseRatingCommand
    {
        return self::create(
            new Uuid(UuidStub::random()),
            CourseIdStub::random()
        );
    }

    public static function create(Uuid $requestId, CourseId $id): UpdateCourseRatingCommand
    {
        return new UpdateCourseRatingCommand($requestId, $id->value());
    }
}
