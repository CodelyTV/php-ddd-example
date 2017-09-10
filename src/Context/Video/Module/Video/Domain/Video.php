<?php

namespace CodelyTv\Context\Video\Module\Video\Domain;

use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Types\Aggregate\AggregateRoot;

final class Video extends AggregateRoot
{
    private $id;
    private $title;
    private $url;
    private $courseId;

    public function __construct(VideoId $id, VideoTitle $title, VideoUrl $url, CourseId $courseId)
    {
        $this->id       = $id;
        $this->title    = $title;
        $this->url      = $url;
        $this->courseId = $courseId;
    }

    public static function create(VideoId $id, VideoTitle $title, VideoUrl $url, CourseId $courseId)
    {
        $video = new self($id, $title, $url, $courseId);

        $video->record(
            new VideoCreatedDomainEvent(
                $id,
                [
                    'title'    => $title->value(),
                    'url'      => $url->value(),
                    'courseId' => $courseId->value(),
                ]
            )
        );

        return $video;
    }

    public function id() : VideoId
    {
        return $this->id;
    }

    public function title() : VideoTitle
    {
        return $this->title;
    }

    public function url() : VideoUrl
    {
        return $this->url;
    }

    public function courseId() : CourseId
    {
        return $this->courseId;
    }
}
