<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\User\Domain;

use CodelyTv\Mooc\Module\User\Application\Find\UserResponse;
use CodelyTv\Mooc\Module\User\Domain\TotalVideosCreated;
use CodelyTv\Mooc\Module\User\Domain\UserId;
use CodelyTv\Mooc\Module\User\Domain\UserName;

final class UserResponseMother
{
    public static function create(UserId $id, UserName $name, TotalVideosCreated $totalPendingVideos)
    {
        return new UserResponse($id->value(), $name->value(), $totalPendingVideos->value());
    }

    public static function random()
    {
        return self::create(UserIdMother::random(), UserNameMother::random(), TotalVideosCreatedMother::random());
    }
}
