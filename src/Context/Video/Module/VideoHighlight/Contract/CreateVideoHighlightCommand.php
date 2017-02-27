<?php

namespace CodelyTv\Context\Video\Module\VideoHighlight\Contract;

use CodelyTv\Shared\Domain\Bus\Command\Command;

final class CreateVideoHighlightCommand implements Command
{
    private $id;
    private $from;
    private $to;
    private $message;

    public function __construct(string $id, int $from, int $to, string $message)
    {
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
