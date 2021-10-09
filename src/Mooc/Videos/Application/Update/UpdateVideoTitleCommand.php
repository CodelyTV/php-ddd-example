<?php

namespace CodelyTv\Mooc\Videos\Application\Update;

use CodelyTv\Shared\Domain\Bus\Command\Command;

class UpdateVideoTitleCommand implements Command
{

    public function __construct(
        private string $id,
        private string $title
    )
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }


}
