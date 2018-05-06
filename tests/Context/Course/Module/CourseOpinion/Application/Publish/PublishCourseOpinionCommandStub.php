<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Application\Publish;

use CodelyTv\Context\Course\Module\CourseOpinion\Application\Publish\PublishCourseOpinionCommand;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionId;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionIdStub;
use CodelyTv\Test\Shared\Domain\UuidStub;
use CodelyTv\Types\ValueObject\Uuid;

final class PublishCourseOpinionCommandStub
{
    /**
     * @return PublishCourseOpinionCommand
     *
     * @throws \Exception
     */
    public static function random(): PublishCourseOpinionCommand
    {
        return self::create(
            new Uuid(UuidStub::random()),
            CourseOpinionIdStub::random()
        );
    }

    public static function create(Uuid $requestId, CourseOpinionId $id): PublishCourseOpinionCommand
    {
        return new PublishCourseOpinionCommand($requestId, $id->value());
    }
}
