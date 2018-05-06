<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Types\ValueObject\Uuid;

final class CreateCourseOpinionCommand extends Command
{
    private $id;
    private $courseId;
    private $rating;
    private $text;

    public function __construct(Uuid $messageId, string $courseId, string $id, int $rating, string $text)
    {
        parent::__construct($messageId);

        $this->courseId = $courseId;
        $this->id       = $id;
        $this->rating   = $rating;
        $this->text     = $text;
    }

    public function courseId(): string
    {
        return $this->courseId;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function rating(): int
    {
        return $this->rating;
    }

    public function text(): string
    {
        return $this->text;
    }
}
