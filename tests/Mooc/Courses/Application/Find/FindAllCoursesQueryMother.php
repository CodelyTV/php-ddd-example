<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Courses\Application\Find;

use CodelyTv\Mooc\Courses\Application\Find\FindAllCoursesQuery;
use PHPUnit\Framework\TestCase;

class FindAllCoursesQueryMother extends TestCase
{
    public static function create(): FindAllCoursesQuery
    {
        return new FindAllCoursesQuery();
    }

    public static function random(): FindAllCoursesQuery
    {
        return self::create();
    }
}
