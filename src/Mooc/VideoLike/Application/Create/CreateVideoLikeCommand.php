<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\VideoLike\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

final class CreateVideoLikeCommand implements Command
{
    public function __construct(
        private readonly Uuid $commandId,
        private readonly string $videoLikeId,
        private readonly string $videoId,
        private readonly string $userId
    ){
        
    }

    public function id(): Uuid
    {
        return $this->id;
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