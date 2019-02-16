<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Video\Application\Create;

use CodelyTv\Mooc\Video\Domain\Video;
use CodelyTv\Mooc\Video\Domain\VideoId;
use CodelyTv\Mooc\Video\Domain\VideoRepository;
use CodelyTv\Mooc\Video\Domain\VideoTitle;
use CodelyTv\Mooc\Video\Domain\VideoType;
use CodelyTv\Mooc\Video\Domain\VideoUrl;
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

    public function create(VideoId $id, VideoType $type, VideoTitle $title, VideoUrl $url, CourseId $courseId)
    {
        $video = Video::create($id, $type, $title, $url, $courseId);

        $this->repository->save($video);

        $this->publisher->publish(...$video->pullDomainEvents());
    }
}
