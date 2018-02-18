<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\User\Domain;

use CodelyTv\Context\Video\Module\User\Application\UserResponse;
use CodelyTv\Context\Video\Module\User\Domain\TotalVideosCreated;
use CodelyTv\Context\Video\Module\User\Domain\UserId;
use CodelyTv\Context\Video\Module\User\Domain\UserName;

final class UserResponseStub
{
    public static function create(UserId $id, UserName $name, TotalVideosCreated $totalPendingVideos)
    {
        return new UserResponse($id->value(), $name->value(), $totalPendingVideos->value());
    }

    public static function random()
    {
        return self::create(UserIdStub::random(), UserNameStub::random(), TotalVideosCreatedStub::random());
    }
}
