<?php


namespace CodelyTv\Backoffice\Videos\Application\Update;


use CodelyTv\Backoffice\Videos\Domain\VideoId;
use CodelyTv\Backoffice\Videos\Domain\VideoNotExist;
use CodelyTv\Backoffice\Videos\Domain\VideoRepository;
use CodelyTv\Backoffice\Videos\Domain\VideoTitle;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;

final class VideoTitleUpdater
{
    private VideoRepository $repository;
    private EventBus $bus;

    public function __construct(VideoRepository $repository, EventBus $bus)
    {
        $this->repository = $repository;
        $this->bus = $bus;
    }

    public function __invoke(VideoTitleUpdaterRequest $request): void
    {
        $videoId = new VideoId($request->videoId());
        $video = $this->repository->search($videoId);
        if ($video === null) {
            throw new VideoNotExist($videoId);
        }
        $video->updateTitle(new VideoTitle($request->videoTitle()));
        $this->repository->update($video);
        $this->bus->publish(...$video->pullDomainEvents());
    }
}