<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\User\Domain;

use CodelyTv\Context\Video\Module\User\Domain\ScalaVideoCreatedDomainEvent;
use CodelyTv\Context\Video\Module\User\Domain\UserId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoIdMother;

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
