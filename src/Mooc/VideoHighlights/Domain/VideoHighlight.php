<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoHighlights\Domain;

use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use CodelyTv\Shared\Domain\SecondsInterval;

final class VideoHighlight extends AggregateRoot
{
    private $id;
    private $interval;
    private $message;

    public function __construct(VideoHighlightId $id, SecondsInterval $interval, VideoHighlightMessage $message)
    {
        $this->id       = $id;
        $this->interval = $interval;
        $this->message  = $message;
    }

    public static function create(
        VideoHighlightId $id,
        SecondsInterval $interval,
        VideoHighlightMessage $message
    ): VideoHighlight {
        $videoHighlight = new self($id, $interval, $message);

        $videoHighlight->record(
            new VideoHighlightCreatedDomainEvent(
                $id->value(),
                [
                    'from'    => $interval->from()->value(),
                    'to'      => $interval->to()->value(),
                    'message' => $message->value(),
                ]
            )
        );

        return $videoHighlight;
    }

    public function id(): VideoHighlightId
    {
        return $this->id;
    }

    public function interval(): SecondsInterval
    {
        return $this->interval;
    }

    public function message(): VideoHighlightMessage
    {
        return $this->message;
    }
}
