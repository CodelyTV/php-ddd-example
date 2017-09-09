<?php

namespace CodelyTv\Context\Video\Module\VideoComment\Contract;

use CodelyTv\Shared\Domain\Bus\Command\Command;

final class PublishVideoCommentCommand implements Command
{
    private $id;
    private $videoId;
    private $content;

    public function __construct(string $id, string $videoId, string $content)
    {
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
