<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Video\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class VideosResponse implements Response
{
    private $videos;

    public function __construct(array $videos)
    {
        $this->videos = $videos;
    }

    public function videos(): array
    {
        return $this->videos;
    }
}
