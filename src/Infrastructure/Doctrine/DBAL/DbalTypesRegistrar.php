<?php

namespace CodelyTv\Infrastructure\Doctrine\DBAL;

use CodelyTv\Context\Video\Module\User\Infrastructure\Persistence\UserIdType;
use CodelyTv\Context\Video\Module\Video\Infrastructure\Persistence\VideoIdType;
use CodelyTv\Shared\Infrastructure\Persistence\Course\CourseIdType;
use Doctrine\DBAL\Types\Type;
use function Lambdish\Phunctional\each;

final class DbalTypesRegistrar
{
    private static $initialized = false;
    private static $types       = [
        CourseIdType::NAME => CourseIdType::class,
        UserIdType::NAME   => UserIdType::class,
        VideoIdType::NAME  => VideoIdType::class,
    ];

    public static function register()
    {
        if (!self::$initialized) {
            each(self::registerType(), self::$types);

            self::$initialized = true;
        }
    }

    private static function registerType()
    {
        return function ($class, $name) {
            Type::addType($name, $class);
        };
    }
}
