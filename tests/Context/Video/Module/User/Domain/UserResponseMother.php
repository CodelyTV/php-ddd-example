<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\User\Domain;

use CodelyTv\Context\Mooc\Module\User\Application\Find\UserResponse;
use CodelyTv\Context\Mooc\Module\User\Domain\TotalVideosCreated;
use CodelyTv\Context\Mooc\Module\User\Domain\UserId;
use CodelyTv\Context\Mooc\Module\User\Domain\UserName;

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
