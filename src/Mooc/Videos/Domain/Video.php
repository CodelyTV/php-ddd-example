<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Shared\Domain\ValueObject\DateTimeObject;

final class Video extends AggregateRoot
{
    private $id;
    private $type;
    private $title;
    private $url;
    private $courseId;
    private $dateTimeAdded;

    public function __construct(VideoId $id, VideoType $type, VideoTitle $title, VideoUrl $url, CourseId $courseId, VideoDateAdded $dateTimeAdded)
    {
        $this->id            = $id;
        $this->type          = $type;
        $this->title         = $title;
        $this->url           = $url;
        $this->courseId      = $courseId;
        $this->dateTimeAdded = $dateTimeAdded;
    }

    public static function create(
        VideoId $id,
        VideoType $type,
        VideoTitle $title,
        VideoUrl $url,
        CourseId $courseId,
        VideoDateAdded $dateTimeAdded
    ): Video {
        $video = new self($id, $type, $title, $url, $courseId, $dateTimeAdded);

        $video->record(
            new VideoCreatedDomainEvent(
                $id->value(),
                [
                    'type'     => $type->value(),
                    'title'    => $title->value(),
                    'url'      => $url->value(),
                    'courseId' => $courseId->value(),
                ]
            )
        );

        return $video;
    }

    public function updateTitle(VideoTitle $newTitle): void
    {
        $this->title = $newTitle;
    }

    public function id(): VideoId
    {
        return $this->id;
    }

    public function type(): VideoType
    {
        return $this->type;
    }

    public function title(): VideoTitle
    {
        return $this->title;
    }

    public function url(): VideoUrl
    {
        return $this->url;
    }

    public function courseId(): CourseId
    {
        return $this->courseId;
    }

    public function dateTimeAdded(): VideoDateAdded
    {
        return $this->dateTimeAdded;
    }
}
