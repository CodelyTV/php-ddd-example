<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Test\Stub;

use CodelyTv\Context\Video\Module\User\Application\UserResponse;
use CodelyTv\Context\Video\Module\User\Domain\TotalPendingVideos;
use CodelyTv\Context\Video\Module\User\Domain\UserId;

final class UserResponseStub
{
    public static function create(UserId $id, TotalPendingVideos $totalPendingVideos)
    {
        return new UserResponse($id->value(), $totalPendingVideos->value());
    }

    public static function random()
    {
        return self::create(UserIdStub::random(), TotalPendingVideosStub::random());
    }
}
