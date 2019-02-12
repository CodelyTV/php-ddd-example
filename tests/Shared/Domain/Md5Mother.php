<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain;

final class Md5Mother
{
    public static function random()
    {
        return MotherCreator::random()->md5;
    }
}
