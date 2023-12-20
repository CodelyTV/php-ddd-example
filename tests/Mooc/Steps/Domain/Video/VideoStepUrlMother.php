<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Steps\Domain\Video;

use CodelyTv\Mooc\Steps\Domain\Video\VideoStepUrl;
use CodelyTv\Tests\Shared\Domain\WordMother;

final class VideoStepUrlMother
{
	public static function create(?string $value = null): VideoStepUrl
	{
		return new VideoStepUrl($value ?? WordMother::create());
	}
}
