<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\User\Domain;

use CodelyTv\Context\Video\Module\User\Domain\TotalVideosCreated;
use CodelyTv\Context\Video\Module\User\Domain\User;
use CodelyTv\Context\Video\Module\User\Domain\UserId;
use CodelyTv\Context\Video\Module\User\Domain\UserName;

final class UserStub
{
    public static function create(UserId $id, UserName $name, TotalVideosCreated $totalPendingVideos)
    {
        return new User($id, $name, $totalPendingVideos);
    }

    public static function withId(UserId $id)
    {
        return self::create($id, UserNameStub::random(), TotalVideosCreatedStub::random());
    }

    public static function withValues(string $id, string $name, int $totalPendingVideos)
    {
        return self::create(
            UserIdStub::create($id),
            UserNameStub::create($name),
            TotalVideosCreatedStub::create($totalPendingVideos)
        );
    }

    public static function random()
    {
        return self::create(UserIdStub::random(), UserNameStub::random(), TotalVideosCreatedStub::random());
    }
}
