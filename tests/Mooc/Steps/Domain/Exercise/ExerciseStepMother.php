<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Steps\Domain\Exercise;

use CodelyTv\Mooc\Steps\Domain\Exercise\ExerciseStep;
use CodelyTv\Mooc\Steps\Domain\Exercise\ExerciseStepContent;
use CodelyTv\Mooc\Steps\Domain\StepDuration;
use CodelyTv\Mooc\Steps\Domain\StepId;
use CodelyTv\Mooc\Steps\Domain\StepTitle;
use CodelyTv\Tests\Mooc\Steps\Domain\StepDurationMother;
use CodelyTv\Tests\Mooc\Steps\Domain\StepIdMother;
use CodelyTv\Tests\Mooc\Steps\Domain\StepTitleMother;

final class ExerciseStepMother
{
	public static function create(
		?StepId $id = null,
		?StepTitle $title = null,
		?StepDuration $duration = null,
		?ExerciseStepContent $content = null
	): ExerciseStep {
		return new ExerciseStep(
			$id ?? StepIdMother::create(),
			$title ?? StepTitleMother::create(),
			$duration ?? StepDurationMother::create(),
			$content ?? ExerciseStepContentMother::create()
		);
	}
}
