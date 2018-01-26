<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Domain;

use CodelyTv\Types\Aggregate\AggregateRootCollection;
use function Lambdish\Phunctional\each;

final class Users extends AggregateRootCollection
{
    protected function type(): string
    {
        return User::class;
    }

    public function increasePending()
    {
        each($this->pendingIncreaser(), $this);
    }

    private function pendingIncreaser()
    {
        return function (User $user) {
            $user->increaseTotalVideosCreated();
        };
    }
}
