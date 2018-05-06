<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\Entity;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Entity\CourseOpinion;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionId;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionRating;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionText;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Test\Context\Course\Module\Course\Domain\CourseIdStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionIdStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionRatingStub;
use CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionTextStub;

final class CourseOpinionStub
{
    /**
     * @return CourseOpinion
     *
     * @throws \Exception
     */
    public static function random(): CourseOpinion
    {
        $courseId = CourseIdStub::random();
        $id       = CourseOpinionIdStub::random();
        $rating   = CourseOpinionRatingStub::random();
        $text     = CourseOpinionTextStub::random();

        return self::create($courseId, $id, $rating, $text);
    }

    public static function create(
        CourseId $courseId,
        CourseOpinionId $id,
        CourseOpinionRating $rating,
        CourseOpinionText $text
    ): CourseOpinion {
        return CourseOpinion::create($courseId, $id, $rating, $text);
    }
}
