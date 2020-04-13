<?php


namespace CodelyTv\Mooc\Courses\Domain;


use CodelyTv\Shared\Domain\Collection;

final class Courses extends Collection
{

    protected function type(): string
    {
        return Course::class;
    }
}