<?php

declare (strict_types = 1);

namespace CodelyTv\Context\Video\Module\Video\Application\Trim;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Types\ValueObject\Uuid;

final class TrimVideoCommand extends Command
{
    private $videoId;
    private $keepFromSecond;
    private $keepToSecond;

    public function __construct(Uuid $commandId, string $videoId, int $keepFromSecond, int $keepToSecond)
    {
        parent::__construct($commandId);

        $this->videoId        = $videoId;
        $this->keepFromSecond = $keepFromSecond;
        $this->keepToSecond   = $keepToSecond;
    }

    public function videoId(): string
    {
        return $this->videoId;
    }

    public function keepFromSecond(): int
    {
        return $this->keepFromSecond;
    }

    public function keepToSecond(): int
    {
        return $this->keepToSecond;
    }
}
