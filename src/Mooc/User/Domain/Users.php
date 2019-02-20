<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\User\Domain;

use CodelyTv\Shared\Domain\Aggregate\AggregateRootCollection;
use function Lambdish\Phunctional\each;

final class Users extends AggregateRootCollection
{
    protected function type(): string
    {
        return User::class;
    }

    public function increasePending(): void
    {
        each($this->pendingIncreaser(), $this);
    }

    private function pendingIncreaser(): callable
    {
        return function (User $user): void {
            $user->increaseTotalVideosCreated();
        };
    }
}
