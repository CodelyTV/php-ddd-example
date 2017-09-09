<?php

namespace CodelyTv\Context\Video\Module\VideoHighlight\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Types\ValueObject\Uuid;

final class CreateVideoHighlightCommand extends Command
{
    private $id;
    private $from;
    private $to;
    private $message;

    public function __construct(Uuid $commandId, string $id, int $from, int $to, string $message)
    {
        parent::__construct($commandId);

        $this->id      = $id;
        $this->from    = $from;
        $this->to      = $to;
        $this->message = $message;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function from(): int
    {
        return $this->from;
    }

    public function to(): int
    {
        return $this->to;
    }

    public function message(): string
    {
        return $this->message;
    }
}
