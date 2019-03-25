<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Steps\Infrastructure\Persistence;

use CodelyTv\Mooc\Steps\Domain\Step;
use CodelyTv\Mooc\Steps\Domain\StepRepository;
use CodelyTv\Mooc\Steps\Infrastructure\Persistence\StepRepositoryMySql;
use CodelyTv\Test\Mooc\Steps\Domain\Challenge\ChallengeStepMother;
use CodelyTv\Test\Mooc\Steps\Domain\Quiz\QuizStepMother;
use CodelyTv\Test\Mooc\Steps\Domain\Video\VideoStepMother;
use CodelyTv\Test\Mooc\Steps\StepsModuleFunctionalTestCase;

final class StepRepositoryTest extends StepsModuleFunctionalTestCase
{
    /**
     * @test
     * @dataProvider validSteps
     */
    public function it_should_save_steps(Step $step): void
    {
        $this->repository()->save($step);
    }

    public function validSteps(): array
    {
        return [
            ['challenge step' => ChallengeStepMother::random()],
            ['quiz step' => QuizStepMother::random()],
            ['video step' => VideoStepMother::random()],
        ];
    }

    private function repository(): StepRepository
    {
        return $this->service(StepRepositoryMySql::class);
    }
}
