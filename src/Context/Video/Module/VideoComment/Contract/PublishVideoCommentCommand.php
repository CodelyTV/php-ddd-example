<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\VideoComment\Contract;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Types\ValueObject\Uuid;

final class PublishVideoCommentCommand extends Command
{
    private $id;
    private $videoId;
    private $content;

    public function __construct(Uuid $commandId, string $id, string $videoId, string $content)
    {
        parent::__construct($commandId);

        $this->id      = $id;
        $this->videoId = $videoId;
        $this->content = $content;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function videoId(): string
    {
        return $this->videoId;
    }

    public function content(): string
    {
        return $this->content;
    }
}
