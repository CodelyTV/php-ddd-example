<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Application\Rate;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Types\ValueObject\Uuid;

final class UpdateCourseRatingCommand extends Command
{
    private $id;

    public function __construct(Uuid $messageId, string $id)
    {
        parent::__construct($messageId);

        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
