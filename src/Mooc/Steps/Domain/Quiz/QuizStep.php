<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Steps\Domain\Quiz;

use CodelyTv\Mooc\Steps\Domain\Step;
use CodelyTv\Mooc\Steps\Domain\StepDuration;
use CodelyTv\Mooc\Steps\Domain\StepId;
use CodelyTv\Mooc\Steps\Domain\StepTitle;

final class QuizStep extends Step
{
	/** @var QuizStepQuestion[] */
	private array $questions;

	public function __construct(
		StepId $id,
		StepTitle $title,
		StepDuration $duration,
		QuizStepQuestion ...$questions
	) {
		parent::__construct($id, $title, $duration);

		$this->questions = $questions;
	}
}
