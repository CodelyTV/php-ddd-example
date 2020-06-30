<?php

declare (strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Trim;

use CodelyTv\Shared\Domain\Bus\Command\Command;

final class TrimVideoCommand implements Command
{
    private string $videoId;
    private int    $keepFromSecond;
    private int    $keepToSecond;

    public function __construct(string $videoId, int $keepFromSecond, int $keepToSecond)
    {
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
