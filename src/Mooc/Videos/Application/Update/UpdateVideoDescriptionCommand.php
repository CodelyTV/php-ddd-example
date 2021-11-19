<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\Command;

final class UpdateVideoDescriptionCommand implements Command
{
    public function __construct(private string $id, private string $description)
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function description(): string
    {
        return $this->description;
    }
}