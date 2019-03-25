<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Doctrine\DBAL;

use CodelyTv\Mooc\Steps\Infrastructure\Persistence\QuizStepQuestionsType;
use CodelyTv\Mooc\Steps\Infrastructure\Persistence\StepIdType;
use CodelyTv\Mooc\Students\Infrastructure\Persistence\StudentIdType;
use CodelyTv\Mooc\Videos\Infrastructure\Persistence\VideoIdType;
use CodelyTv\Shared\Infrastructure\Persistence\Course\CourseIdType;
use CodelyTv\Shared\Infrastructure\Persistence\Lesson\LessonIdType;
use Doctrine\DBAL\Types\Type;
use function Lambdish\Phunctional\each;

final class DbalTypesRegistrar
{
    private static $initialized = false;
    private static $types = [
        CourseIdType::NAME          => CourseIdType::class,
        LessonIdType::NAME          => LessonIdType::class,
        QuizStepQuestionsType::NAME => QuizStepQuestionsType::class,
        StudentIdType::NAME         => StudentIdType::class,
        StepIdType::NAME            => StepIdType::class,
        VideoIdType::NAME           => VideoIdType::class,
    ];

    public static function register(): void
    {
        if (!self::$initialized) {
            each(self::registerType(), self::$types);

            self::$initialized = true;
        }
    }

    private static function registerType(): callable
    {
        return function ($class, $name): void {
            Type::addType($name, $class);
        };
    }
}
