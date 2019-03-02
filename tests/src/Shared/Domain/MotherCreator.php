<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain;

use Faker\Factory;

final class MotherCreator
{
    private static $faker;

    public static function random(): \Faker\Generator
    {
        return self::faker();
    }

    protected static function faker(): \Faker\Generator
    {
        return self::$faker = self::$faker ?: Factory::create();
    }
}
