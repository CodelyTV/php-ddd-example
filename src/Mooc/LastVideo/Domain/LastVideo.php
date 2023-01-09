<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoId;
use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;

final class LastVideo extends AggregateRoot
{
    public function __construct(
        private readonly  LastVideoId         $id,
        private           VideoId             $videoId,
        private           LastVideoType       $type,
        private           LastVideoTitle      $title,
        private           LastVideoUrl        $url,
        private           CourseId            $courseId,
        private           LastVideoCreatedAt  $createdAt
    ) {
    }

    public static function create(
        LastVideoId $id,
        VideoId $videoId,
        LastVideoType $type,
        LastVideoTitle $title,
        LastVideoUrl $url,
        CourseId $courseId,
        LastVideoCreatedAt $createdAt
    ): LastVideo {
        return new self($id, $videoId, $type, $title, $url, $courseId, $createdAt);
    }

    public function isOutdated(LastVideoCreatedAt $createdAt): bool
    {
        return $this->createdAt->isBefore($createdAt);
    }

    public function id(): LastVideoId
    {
        return $this->id;
    }

    public function videoId(): VideoId
    {
        return $this->videoId;
    }

    public function type(): LastVideoType
    {
        return $this->type;
    }

    public function title(): LastVideoTitle
    {
        return $this->title;
    }

    public function url(): LastVideoUrl
    {
        return $this->url;
    }

    public function courseId(): CourseId
    {
        return $this->courseId;
    }

    public function createdAt(): LastVideoCreatedAt
    {
        return $this->createdAt;
    }

    public function updateVideoData(
        VideoId $videoId,
        LastVideoType $type,
        LastVideoTitle $title,
        LastVideoUrl $url,
        CourseId $courseId,
        LastVideoCreatedAt $createdAt
    ): void {
        $this->videoId = $videoId;
        $this->type = $type;
        $this->title = $title;
        $this->url = $url;
        $this->courseId = $courseId;
        $this->createdAt = $createdAt;
    }

    public function __toString(): string
    {
        return '{"id":"' . $this->id->value() . '","videoId":"' . $this->videoId->value() . '","type":"' . $this->type->value() . '","title":"' . $this->title->value() . '","url":"' . $this->url->value() . '","courseId":"' . $this->courseId->value() . '","createdAt":"' . $this->createdAt->value() . '"}';
    }
}
