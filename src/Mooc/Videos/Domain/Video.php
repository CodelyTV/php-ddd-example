<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoPublished;
use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;

final class Video extends AggregateRoot
{
    private $id;
    private $type;
    private $title;
    private $url;
    private $courseId;
    private $publishDate;

    public function __construct(VideoId $id, VideoType $type, VideoTitle $title, VideoUrl $url, CourseId $courseId,
                                VideoPublished $publishDate
    )
    {
        $this->id           = $id;
        $this->type         = $type;
        $this->title        = $title;
        $this->url          = $url;
        $this->courseId     = $courseId;
        $this->publishDate  = $publishDate;
    }

    public static function create(
        VideoId $id,
        VideoType $type,
        VideoTitle $title,
        VideoUrl $url,
        CourseId $courseId,
        VideoPublished $publishDate
    ): Video {
        $video = new self($id, $type, $title, $url, $courseId, $publishDate);

        $video->record(
            new VideoCreatedDomainEvent(
                $id->value(),
                [
                    'type'     => $type->value(),
                    'title'    => $title->value(),
                    'url'      => $url->value(),
                    'courseId' => $courseId->value(),
                    'publishDate' => $publishDate->value(),
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

    public function publishDate(): VideoPublished
    {
        return $this->publishDate;
    }
}
