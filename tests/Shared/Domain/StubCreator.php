<?php

namespace CodelyTv\Test\Shared\Domain;

use Faker\Factory;

final class StubCreator
{
    private static $faker;

    public static function random()
    {
        return self::faker();
    }

    protected static function faker()
    {
        return self::$faker = self::$faker ?: Factory::create();
    }
}
