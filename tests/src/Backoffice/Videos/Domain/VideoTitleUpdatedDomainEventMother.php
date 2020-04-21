<?php


namespace CodelyTv\Tests\Backoffice\Videos\Domain;


use CodelyTv\Backoffice\Videos\Domain\Video;
use CodelyTv\Backoffice\Videos\Domain\VideoId;
use CodelyTv\Backoffice\Videos\Domain\VideoTitle;
use CodelyTv\Backoffice\Videos\Domain\VideoTitleUpdatedDomainEvent;

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