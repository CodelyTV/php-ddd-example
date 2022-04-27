<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use DateTimeImmutable;

final class Video extends AggregateRoot
{
    public function __construct(
        private VideoId $id,
        private VideoType $type,
        private VideoTitle $title,
        private VideoUrl $url,
        private CourseId $courseId,
        private DateTimeImmutable $createdAt
    ) {
    }

    public static function create(
        VideoId $id,
        VideoType $type,
        VideoTitle $title,
        VideoUrl $url,
        CourseId $courseId
    ): Video {
        $video = new self($id, $type, $title, $url, $courseId, new DateTimeImmutable());

        $video->record(
            new VideoCreatedDomainEvent(
                $id->value(), $type->value(), $title->value(), $url->value(), $courseId->value()
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
