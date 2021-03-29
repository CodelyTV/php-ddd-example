<?php

declare (strict_types=1);

namespace CodelyTv\OpenFlight\Videos\Application\Trim;

use CodelyTv\OpenFlight\Videos\Domain\VideoId;
use CodelyTv\Shared\Domain\SecondsInterval;

final class VideoTrimmer
{
    public function trim(VideoId $id, SecondsInterval $interval): void
    {
    }
}
