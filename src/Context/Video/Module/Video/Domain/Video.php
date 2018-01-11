<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Domain;

use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Types\Aggregate\AggregateRoot;

final class Video extends AggregateRoot
{
    private $id;
    private $type;
    private $title;
    private $url;
    private $courseId;

    public function __construct(VideoId $id, VideoType $type, VideoTitle $title, VideoUrl $url, CourseId $courseId)
    {
        $this->id       = $id;
        $this->type     = $type;
        $this->title    = $title;
        $this->url      = $url;
        $this->courseId = $courseId;
    }

    public static function create(
        VideoId $id,
        VideoType $type,
        VideoTitle $title,
        VideoUrl $url,
        CourseId $courseId
    ): Video {
        $video = new self($id, $type, $title, $url, $courseId);

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
}
