<?php

namespace CodelyTv\Context\Video\Module\VideoHighlight\Domain;

use CodelyTv\Shared\Domain\SecondsInterval;
use CodelyTv\Types\Aggregate\AggregateRoot;

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

    public static function create(VideoHighlightId $id, SecondsInterval $interval, VideoHighlightMessage $message)
    {
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
