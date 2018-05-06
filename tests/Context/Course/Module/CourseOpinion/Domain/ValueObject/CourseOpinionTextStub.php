<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Course\Module\CourseOpinion\Domain\ValueObject;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionText;

final class CourseOpinionTextStub
{
    /**
     * @param int $length
     *
     * @return CourseOpinionText
     *
     * @throws \Exception
     */
    public static function random(int $length = 300): CourseOpinionText
    {
        return self::create(
            str_repeat('a', $length)
        );
    }

    /**
     * @param string $text
     *
     * @return CourseOpinionText
     *
     * @throws \Exception
     */
    public static function create(string $text): CourseOpinionText
    {
        return new CourseOpinionText($text);
    }
}
