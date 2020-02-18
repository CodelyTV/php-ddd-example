<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\CoursesCounter\Domain;

use CodelyTv\Shared\Domain\UuidGenerator;

final class CoursesCounterInitializer
{
    private $uuidGenerator;

    public function __construct(UuidGenerator $uuidGenerator)
    {
        $this->uuidGenerator = $uuidGenerator;
    }

    public function __invoke(): CoursesCounter
    {
        return CoursesCounter::initialize(new CoursesCounterId($this->uuidGenerator->generate()));
    }
}
