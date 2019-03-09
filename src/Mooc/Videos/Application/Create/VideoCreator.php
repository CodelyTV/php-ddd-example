<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Application\Create;

use CodelyTv\Mooc\Shared\Domain\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use CodelyTv\Shared\Domain\CourseId;

final class VideoCreator
{
    private $repository;
    private $publisher;

    public function __construct(VideoRepository $repository, DomainEventPublisher $publisher)
    {
        $this->repository = $repository;
        $this->publisher  = $publisher;
    }

    public function create(VideoId $id, VideoType $type, VideoTitle $title, VideoUrl $url, CourseId $courseId): void
    {
        $video = Video::create($id, $type, $title, $url, $courseId);

        $this->repository->save($video);

        $this->publisher->publish(...$video->pullDomainEvents());
    }
}
