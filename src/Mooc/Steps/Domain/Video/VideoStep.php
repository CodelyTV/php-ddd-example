<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Domain\Video;

use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Steps\Domain\Step;
use CodelyTv\Mooc\Steps\Domain\StepEstimatedDuration;
use CodelyTv\Mooc\Steps\Domain\StepId;
use CodelyTv\Mooc\Steps\Domain\StepOrder;
use CodelyTv\Mooc\Steps\Domain\StepPoints;
use CodelyTv\Mooc\Steps\Domain\StepTitle;
use DateTimeImmutable;
use function CodelyTv\Utils\Shared\date_to_string;

final class VideoStep extends Step
{
    private $videoUrl;
    private $text;

    public function __construct(
        StepId $id,
        LessonId $lessonId,
        StepTitle $title,
        StepEstimatedDuration $estimatedDuration,
        StepOrder $order,
        DateTimeImmutable $creationDate,
        VideoUrl $videoUrl,
        VideoStepText $text
    ) {
        parent::__construct($id, $lessonId, $title, $estimatedDuration, $order, $creationDate);

        $this->videoUrl = $videoUrl;
        $this->text     = $text;
    }

    public static function create(
        StepId $id,
        LessonId $lessonId,
        StepTitle $title,
        StepEstimatedDuration $estimatedDuration,
        StepOrder $order,
        VideoUrl $videoUrl,
        VideoStepText $text
    ): self {
        $step = new self($id, $lessonId, $title, $estimatedDuration, $order, new DateTimeImmutable(), $videoUrl, $text);

        $step->record(
            new VideoStepCreatedDomainEvent(
                $id->value(),
                [
                    'lessonId'          => $lessonId->value(),
                    'title'             => $title->value(),
                    'estimatedDuration' => $estimatedDuration->value(),
                    'creationDate'      => date_to_string($step->creationDate()),
                    'url'               => $videoUrl->value(),
                    'text'              => $text->value(),
                ]
            )
        );

        return $step;
    }

    public function points(): StepPoints
    {
        return new StepPoints(100);
    }

    public function videoUrl(): VideoUrl
    {
        return $this->videoUrl;
    }

    public function text(): VideoStepText
    {
        return $this->text;
    }
}
