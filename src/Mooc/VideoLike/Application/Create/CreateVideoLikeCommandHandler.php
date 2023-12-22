<?php

namespace CodelyTv\Mooc\VideoLike\Application\Create;

use CodelyTv\Mooc\VideoLike\Domain\UserId;
use CodelyTv\Mooc\VideoLike\Domain\VideoLikeId;
use CodelyTv\Mooc\Videos\Domain\VideoId;

final class CreateVideoLikeCommandHandler
{
    public function __construct(private VideoLikeCreator $creator)
    {
    }

    public function __invoke(CreateVideoLikeCommand $command): void
    {
        $id = new VideoLikeId($command->videoLikeId());

        $userId = new UserId($command->userId());

        $videoId = new VideoId($command->videoId());

        $this->creator->__invoke($id, $userId, $videoId);
    }
}