<?php


namespace CodelyTv\Tests\Mooc\Videos\Domain;


use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoTitleUpdatedDomainEvent;

final class VideoTitleUpdatedDomainEventMother
{

    private static function create(VideoId $id, VideoTitle $title): VideoTitleUpdatedDomainEvent
    {
        return new VideoTitleUpdatedDomainEvent($id->value(), $title->value());
    }

    public static function fromVideo(Video $updatedVideo): VideoTitleUpdatedDomainEvent
    {
        return self::create($updatedVideo->id(), $updatedVideo->title());
    }


}