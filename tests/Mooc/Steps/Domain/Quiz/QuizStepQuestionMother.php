<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Steps\Domain\Quiz;

use CodelyTv\Mooc\Steps\Domain\Quiz\QuizStepQuestion;
use CodelyTv\Tests\Shared\Domain\Repeater;
use CodelyTv\Tests\Shared\Domain\WordMother;

final class QuizStepQuestionMother
{
	public static function create(?string $question = null, array $answers = []): QuizStepQuestion
	{
		return new QuizStepQuestion(
			$question ?? WordMother::create(),
			count($answers) !== 0 ? $answers : Repeater::random(fn (): string => WordMother::create())
		);
	}
}
