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
