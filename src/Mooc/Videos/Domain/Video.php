<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;

final class Video extends AggregateRoot
{
    public function __construct(
        private VideoId $id,
        private VideoType $type,
        private VideoTitle $title,
        private VideoDescription $description,
        private VideoUrl $url,
        private CourseId $courseId
    ) {
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
                $id->value(), $type->value(), $title->value(), $description->value(), $url->value(), $courseId->value()
            )
        );

        return $video;
    }

    public function updateTitle(VideoTitle $newTitle): void
    {
        $this->title = $newTitle;
    }

    public function updateDescription(VideoDescription $newDescription): void
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
