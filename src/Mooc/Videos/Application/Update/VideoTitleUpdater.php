<?php


namespace CodelyTv\Mooc\Videos\Application\Update;


use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoNotExist;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;

final class VideoTitleUpdater
{
    private VideoRepository $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(VideoTitleUpdaterRequest $request): void
    {
        $videoId = new VideoId($request->videoId());
        $video = $this->repository->search($videoId);
        if ($video === null) {
            throw new VideoNotExist($videoId);
        }
        $video->changeTitle(new VideoTitle($request->videoTitle()));
        $this->repository->update($video);
    }
}