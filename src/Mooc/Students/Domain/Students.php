<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Students\Domain;

use CodelyTv\Shared\Domain\Aggregate\AggregateRootCollection;
use function Lambdish\Phunctional\each;

final class Students extends AggregateRootCollection
{
    protected function type(): string
    {
        return Student::class;
    }

    public function increasePending(): void
    {
        each($this->pendingIncreaser(), $this);
    }

    private function pendingIncreaser(): callable
    {
        return function (Student $student): void {
            $student->increaseTotalVideosCreated();
        };
    }
}
