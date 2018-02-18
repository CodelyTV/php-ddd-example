<?php

namespace CodelyTv\Test\Infrastructure\Bus\Query;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class FakeResponse implements Response
{
    private $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function number(): int
    {
        return $this->number;
    }
}
