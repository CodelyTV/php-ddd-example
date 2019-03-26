<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Lessons\Application\RecalculateEstimatedDuration;

use CodelyTv\Mooc\Lessons\Domain\LessonEstimatedDuration;
use CodelyTv\Mooc\Lessons\Domain\LessonFinder;
use CodelyTv\Mooc\Lessons\Domain\LessonRepository;
use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;
use CodelyTv\Mooc\Steps\Application\SearchByLesson\SearchStepsByLessonQuery;
use CodelyTv\Mooc\Steps\Application\StepResponse;
use CodelyTv\Mooc\Steps\Application\StepsResponse;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use CodelyTv\Shared\Domain\Bus\Query\QueryBus;
use function Lambdish\Phunctional\reduce;

final class LessonEstimatedDurationRecalculator
{
    private $bus;
    private $finder;
    private $repository;
    private $publisher;

    public function __construct(QueryBus $bus, LessonRepository $repository, DomainEventPublisher $publisher)
    {
        $this->bus        = $bus;
        $this->finder     = new LessonFinder($repository);
        $this->repository = $repository;
        $this->publisher  = $publisher;
    }

    public function __invoke(LessonId $id)
    {
        $lesson                        = $this->finder->find($id);
        $recalculatedEstimatedDuration = new LessonEstimatedDuration($this->sumStepsEstimatedDurationFor($id));

        $lesson->recalculateEstimatedDuration($recalculatedEstimatedDuration);

        $this->repository->save($lesson);

        $this->publisher->publish(...$lesson->pullDomainEvents());
    }

    private function sumStepsEstimatedDurationFor(LessonId $id): int
    {
        $steps = $this->askForSteps($id);

        return reduce($this->durationAdder(), $steps, 0);
    }

    private function askForSteps(LessonId $id): StepsResponse
    {
        $query = new SearchStepsByLessonQuery($id->value());

        return $this->bus->ask($query);
    }

    private function durationAdder(): callable
    {
        return static function (int $totalDuration, StepResponse $step): int {
            return $totalDuration + $step->estimatedDuration();
        };
    }
}
