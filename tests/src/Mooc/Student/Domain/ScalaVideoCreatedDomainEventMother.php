<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Student\Domain;

use CodelyTv\Mooc\Student\Domain\ScalaVideoCreatedDomainEvent;
use CodelyTv\Mooc\Student\Domain\StudentId;
use CodelyTv\Mooc\Video\Domain\VideoId;
use CodelyTv\Test\Mooc\Video\Domain\VideoIdMother;

final class ScalaVideoCreatedDomainEventMother
{
    public static function create(VideoId $id, StudentId $userId)
    {
        return new ScalaVideoCreatedDomainEvent($id->value(), ['creatorId' => $userId->value()]);
    }

    public static function random()
    {
        return self::create(VideoIdMother::random(), StudentIdMother::random());
    }
}
