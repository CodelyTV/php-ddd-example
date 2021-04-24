<?php

declare(strict_types=1);


namespace CodelyTv\Tests\Shared\Domain;


use CodelyTv\Mooc\Videos\Domain\VideoType;

final class TypeMother
{
    public static function create(): string
    {
        return VideoType::random()->value();
    }
}
