<?php

namespace CodelyTv\Context\Video\Module\Video\Domain\Find;

use CodelyTv\Infrastructure\Bus\Query\Query;

final class FindVideoQuery implements Query
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
