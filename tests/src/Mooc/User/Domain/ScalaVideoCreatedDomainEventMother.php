<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\User\Domain;

use CodelyTv\Mooc\User\Domain\ScalaVideoCreatedDomainEvent;
use CodelyTv\Mooc\User\Domain\UserId;
use CodelyTv\Mooc\Video\Domain\VideoId;
use CodelyTv\Test\Mooc\Video\Domain\VideoIdMother;

final class ScalaVideoCreatedDomainEventMother
{
    public static function create(VideoId $id, UserId $userId)
    {
        return new ScalaVideoCreatedDomainEvent($id->value(), ['creatorId' => $userId->value()]);
    }

    public static function random()
    {
        return self::create(VideoIdMother::random(), UserIdMother::random());
    }
}
