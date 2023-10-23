<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Trim;

use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Shared\Domain\SecondsInterval;

final class VideoTrimmer
{
	public function trim(VideoId $id, SecondsInterval $interval): void {}
}
