<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Test\Stub;

use CodelyTv\Context\Video\Module\User\Domain\TotalVideosCreated;
use CodelyTv\Context\Video\Module\User\Domain\User;
use CodelyTv\Context\Video\Module\User\Domain\UserId;

final class UserStub
{
    public static function create(UserId $id, TotalVideosCreated $totalPendingVideos)
    {
        return new User($id, $totalPendingVideos);
    }

    public static function withId(UserId $id)
    {
        return self::create($id, TotalVideosCreatedStub::random());
    }

    public static function withValues(string $id, int $totalPendingVideos)
    {
        return self::create(UserIdStub::create($id), TotalVideosCreatedStub::create($totalPendingVideos));
    }

    public static function random()
    {
        return self::create(UserIdStub::random(), TotalVideosCreatedStub::random());
    }
}
