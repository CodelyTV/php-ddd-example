<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\CoursesCounter\Domain;

use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterInitializer;
use CodelyTv\Shared\Domain\UuidGenerator;

final class CoursesCounterInitializerMother
{
    public static function create(
        UuidGenerator $uuidGenerator
    ): CoursesCounterInitializer {
        return new CoursesCounterInitializer($uuidGenerator);
    }
}
