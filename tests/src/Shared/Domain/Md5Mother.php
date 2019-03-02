<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain;

final class Md5Mother
{
    public static function random(): string
    {
        return MotherCreator::random()->md5;
    }
}
