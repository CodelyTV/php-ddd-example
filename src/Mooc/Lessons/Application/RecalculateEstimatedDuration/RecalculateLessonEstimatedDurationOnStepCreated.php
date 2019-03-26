<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Lessons\Application\RecalculateEstimatedDuration;

use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;
use CodelyTv\Mooc\Steps\Domain\Challenge\ChallengeStepCreatedDomainEvent;
use CodelyTv\Mooc\Steps\Domain\Quiz\QuizStepCreatedDomainEvent;
use CodelyTv\Mooc\Steps\Domain\StepCreatedDomainEvent;
use CodelyTv\Mooc\Steps\Domain\Video\VideoStepCreatedDomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use function Lambdish\Phunctional\apply;

final class RecalculateLessonEstimatedDurationOnStepCreated implements DomainEventSubscriber
{
    private $recalculator;

    public function __construct(LessonEstimatedDurationRecalculator $recalculator)
    {
        $this->recalculator = $recalculator;
    }

    public static function subscribedTo(): array
    {
        return [
            ChallengeStepCreatedDomainEvent::class,
            QuizStepCreatedDomainEvent::class,
            VideoStepCreatedDomainEvent::class,
        ];
    }

    public function __invoke(StepCreatedDomainEvent $event)
    {
        $id = new LessonId($event->lessonId());

        apply($this->recalculator, [$id]);
    }
}
