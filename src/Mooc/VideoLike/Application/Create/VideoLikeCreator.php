<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\VideoLike\Application\Create;

use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoLikeId;
use CodelyTv\Shared\Domain\ValueObject\UserId;
use CodelyTv\Mooc\Videos\Domain\VideoLike;

final class VideoLikeCreator
{
    public function __construct(private readonly VideoLikeRepository $repository, private readonly EventBus $bus)
    {
    }

    public function create(VideoLikeId $id, VideoId $videoId, UserId $userId): void
    {
        $videoLike = VideoLike::create($id, $videoId, $userId);

        $this->repository->save($videoLike);

        $this->bus->publish(...$videoLike->pullDomainEvents());
    }
}