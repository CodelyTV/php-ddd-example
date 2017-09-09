<?php

declare (strict_types = 1);

namespace CodelyTv\Context\Video\Module\Video\Application\Trim;

use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Shared\Domain\SecondsInterval;

final class TrimVideoCommandHandler
{
    private $trimmer;

    public function __construct(VideoTrimmer $trimmer)
    {
        $this->trimmer = $trimmer;
    }

    public function __invoke(TrimVideoCommand $command)
    {
        $id       = new VideoId($command->videoId());
        $interval = SecondsInterval::fromValues($command->keepFromSecond(), $command->keepToSecond());

        $this->trimmer->trim($id, $interval);
    }
}
