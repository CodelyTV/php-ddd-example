<?php
declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Review\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Types\ValueObject\Uuid;

final class CreateVideoReviewCommand extends Command
{
    private $id;
    private $videoId;
    private $rating;
    private $text;

    public function __construct(Uuid $commandId, string $id, string $videoId, int $rating, ?string $text)
    {
        parent::__construct($commandId);

        $this->id = $id;
        $this->videoId = $videoId;
        $this->rating = $rating;
        $this->text = $text;
    }

    public function id() : string
    {
        return $this->id;
    }

    public function videoId() : string
    {
        return $this->videoId;
    }

    public function rating() : int
    {
        return $this->rating;
    }

    public function text() : ?string
    {
        return $this->text;
    }
}
