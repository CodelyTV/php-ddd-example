<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;

final class Video extends AggregateRoot
{
    private $id;
    private $type;
    private $title;
    private $description;
    private $url;
    private $courseId;

    public function __construct(VideoId $id, VideoType $type, VideoTitle $title, VideoDescription $description, VideoUrl $url, CourseId $courseId)
    {
        $this->id       = $id;
        $this->type     = $type;
        $this->title    = $title;
        $this->description = $description;
        $this->url      = $url;
        $this->courseId = $courseId;
    }

    public static function create(
        VideoId $id,
        VideoType $type,
        VideoTitle $title,
        VideoDescription $description,
        VideoUrl $url,
        CourseId $courseId
    ): Video {
        $video = new self($id, $type, $title, $description, $url, $courseId);

        $video->record(
            new VideoCreatedDomainEvent(
                $id->value(),
                [
                    'type'     => $type->value(),
                    'title'    => $title->value(),
                    'description' => $description->value(),
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

    public function modifyDescription(VideoDescription $newDescription): void
    {
        $this->description = $newDescription;
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

    public function description(): VideoDescription
    {
        return $this->description;
    }

    public function url(): VideoUrl
    {
        return $this->url;
    }

    public function courseId(): CourseId
    {
        return $this->courseId;
    }
}
