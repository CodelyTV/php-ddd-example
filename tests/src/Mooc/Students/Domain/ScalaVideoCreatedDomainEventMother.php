<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Students\Domain;

use CodelyTv\Mooc\Students\Domain\ScalaVideoCreatedDomainEvent;
use CodelyTv\Mooc\Students\Domain\StudentId;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Test\Mooc\Videos\Domain\VideoIdMother;

final class ScalaVideoCreatedDomainEventMother
{
    public static function create(VideoId $id, StudentId $userId): ScalaVideoCreatedDomainEvent
    {
        return new ScalaVideoCreatedDomainEvent($id->value(), ['creatorId' => $userId->value()]);
    }

    public static function random(): ScalaVideoCreatedDomainEvent
    {
        return self::create(VideoIdMother::random(), StudentIdMother::random());
    }
}
