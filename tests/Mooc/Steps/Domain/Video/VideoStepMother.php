<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Steps\Domain\Video;

use CodelyTv\Mooc\Steps\Domain\StepDuration;
use CodelyTv\Mooc\Steps\Domain\StepId;
use CodelyTv\Mooc\Steps\Domain\StepTitle;
use CodelyTv\Mooc\Steps\Domain\Video\VideoStep;
use CodelyTv\Mooc\Steps\Domain\Video\VideoStepUrl;
use CodelyTv\Tests\Mooc\Steps\Domain\StepDurationMother;
use CodelyTv\Tests\Mooc\Steps\Domain\StepIdMother;
use CodelyTv\Tests\Mooc\Steps\Domain\StepTitleMother;

final class VideoStepMother
{
	public static function create(
		?StepId $id = null,
		?StepTitle $title = null,
		?StepDuration $duration = null,
		?VideoStepUrl $url = null
	): VideoStep {
		return new VideoStep(
			$id ?? StepIdMother::create(),
			$title ?? StepTitleMother::create(),
			$duration ?? StepDurationMother::create(),
			$url ?? VideoStepUrlMother::create()
		);
	}
}
