<?php

namespace CodelyTv\Context\Meetup\Module\Video\Domain\Create;

use CodelyTv\Context\Meetup\Module\Video\Domain\Video;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoId;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoRepository;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoTitle;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoUrl;
use CodelyTv\Infrastructure\Bus\Event\DomainEventPublisher;
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

    public function create(VideoId $id, VideoTitle $title, VideoUrl $url, CourseId $courseId)
    {
        $video = Video::create($id, $title, $url, $courseId);

        $this->repository->save($video);

        $this->publisher->publish($video->pullDomainEvents());
    }
}
