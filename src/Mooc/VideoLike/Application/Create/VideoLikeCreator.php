<?php

namespace CodelyTv\Mooc\VideoLike\Application\Create;

use CodelyTv\Mooc\VideoLike\Domain\UserId;
use CodelyTv\Mooc\VideoLike\Domain\VideoLike;
use CodelyTv\Mooc\VideoLike\Domain\VideoLikeId;
use CodelyTv\Mooc\VideoLike\Domain\VideoLikeRepository;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;

class VideoLikeCreator
{
    public function __construct(
        private VideoLikeRepository $repository,
        private EventBus $publisher
    ) {
    }

    public function __invoke(VideoLikeId $id, UserId $userId, VideoId $videoId): void
    {
        $videoLike = VideoLike::create($id, $userId, $videoId);

        $this->repository->save($videoLike);

        $this->publisher->publish(...$videoLike->pullDomainEvents());
    }
}