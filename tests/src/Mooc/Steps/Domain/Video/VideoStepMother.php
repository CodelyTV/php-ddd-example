<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Steps\Domain\Video;

use CodelyTv\Mooc\Shared\Domain\Lessons\LessonId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Steps\Domain\StepEstimatedDuration;
use CodelyTv\Mooc\Steps\Domain\StepId;
use CodelyTv\Mooc\Steps\Domain\StepOrder;
use CodelyTv\Mooc\Steps\Domain\StepTitle;
use CodelyTv\Mooc\Steps\Domain\Video\VideoStep;
use CodelyTv\Mooc\Steps\Domain\Video\VideoStepQuestion;
use CodelyTv\Mooc\Steps\Domain\Video\VideoStepText;
use CodelyTv\Test\Mooc\Shared\Domain\Lessons\LessonIdMother;
use CodelyTv\Test\Mooc\Shared\Domain\Videos\VideoUrlMother;
use CodelyTv\Test\Mooc\Steps\Domain\StepEstimatedDurationMother;
use CodelyTv\Test\Mooc\Steps\Domain\StepIdMother;
use CodelyTv\Test\Mooc\Steps\Domain\StepOrderMother;
use CodelyTv\Test\Mooc\Steps\Domain\StepTitleMother;
use CodelyTv\Test\Shared\Domain\DateTimeMother;
use DateTimeImmutable;

final class VideoStepMother
{
    public static function create(
        StepId $id,
        LessonId $lessonId,
        StepTitle $title,
        StepEstimatedDuration $estimatedDuration,
        StepOrder $order,
        DateTimeImmutable $creationDate,
        VideoUrl $videoUrl,
        VideoStepText $text
    ): VideoStep {
        return new VideoStep($id, $lessonId, $title, $estimatedDuration, $order, $creationDate, $videoUrl, $text);
    }

    public static function random(): VideoStep
    {
        return self::create(
            StepIdMother::random(),
            LessonIdMother::random(),
            StepTitleMother::random(),
            StepEstimatedDurationMother::random(),
            StepOrderMother::random(),
            DateTimeMother::random(),
            VideoUrlMother::random(),
            VideoStepTextMother::random()
        );
    }
}
