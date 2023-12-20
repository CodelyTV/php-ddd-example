<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Steps\Domain\Quiz;

use CodelyTv\Mooc\Steps\Domain\Quiz\QuizStep;
use CodelyTv\Mooc\Steps\Domain\Quiz\QuizStepQuestion;
use CodelyTv\Mooc\Steps\Domain\StepDuration;
use CodelyTv\Mooc\Steps\Domain\StepId;
use CodelyTv\Mooc\Steps\Domain\StepTitle;
use CodelyTv\Tests\Mooc\Steps\Domain\StepDurationMother;
use CodelyTv\Tests\Mooc\Steps\Domain\StepIdMother;
use CodelyTv\Tests\Mooc\Steps\Domain\StepTitleMother;
use CodelyTv\Tests\Shared\Domain\Repeater;

final class QuizStepMother
{
	public static function create(
		?StepId $id = null,
		?StepTitle $title = null,
		?StepDuration $duration = null,
		QuizStepQuestion ...$questions
	): QuizStep {
		$stepQuestions = count($questions) === 0 ? Repeater::random(
			fn (): QuizStepQuestion => QuizStepQuestionMother::create()
		) : $questions;

		return new QuizStep(
			$id ?? StepIdMother::create(),
			$title ?? StepTitleMother::create(),
			$duration ?? StepDurationMother::create(),
			...$stepQuestions
		);
	}
}
