<?php

namespace CodelyTv\Mooc\VideoLike\Application\Create;

use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Shared\Domain\Bus\Command\Command;

final class CreateVideoLikeCommand implements Command
{
    public function __construct(
        private Uuid $messageId,
        private string $videoLikeId,
        private string $videoId,
        private string $userId
    ) {
    }

    public function messageId(): Uuid
    {
        return $this->messageId;
    }

    public function videoLikeId(): string
    {
        return $this->videoLikeId;
    }

    public function videoId(): string
    {
        return $this->videoId;
    }

    public function userId(): string
    {
        return $this->userId;
    }
}