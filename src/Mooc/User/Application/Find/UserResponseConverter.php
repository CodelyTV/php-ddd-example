<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\User\Application\Find;

use CodelyTv\Mooc\User\Domain\User;

final class UserResponseConverter
{
    public function __invoke(User $user)
    {
        return new UserResponse($user->id()->value(), $user->name()->value(), $user->totalVideosCreated()->value());
    }
}
