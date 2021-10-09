<?php

namespace CodelyTv\Tests\Shared\Domain;

class UrlMother
{
    public static function create(): string
    {
        return MotherCreator::random()->url;
    }
}
