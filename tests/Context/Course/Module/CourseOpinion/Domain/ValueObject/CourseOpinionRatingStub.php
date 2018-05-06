<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionRating;
use CodelyTv\Test\Shared\Domain\NumberStub;

final class CourseOpinionRatingStub
{
    /**
     * @return CourseOpinionRating
     *
     * @throws \Exception
     */
    public static function random(): CourseOpinionRating
    {
        return self::create(
            NumberStub::between(0, 5)
        );
    }

    /**
     * @param $rating
     *
     * @return CourseOpinionRating
     *
     * @throws \Exception
     */
    public static function create($rating): CourseOpinionRating
    {
        return new CourseOpinionRating($rating);
    }
}
