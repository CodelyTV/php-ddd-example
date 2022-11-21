<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\VideoLike\Application\Create;

use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoLikeId;
use CodelyTv\Shared\Domain\ValueObject\UserId;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class CreateVideoLikeCommandHandler implements CommandHandler
{
    public function __construct(private readonly VideoLikeCreator $creator)
    {
    }

    public function __invoke(CreateVideoLikeCommand $command): void
    {
        $id      = new VideoLikeId($command->videoLikeId());
        $videoId = new VideoId($command->videoId());
        $userId  = new UserId($command->userId());

        $this->creator->create($id, $videoId, $userId);
    }
}