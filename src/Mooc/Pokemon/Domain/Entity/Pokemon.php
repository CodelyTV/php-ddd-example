<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Pokemon\Domain\Entity;

readonly class Pokemon
{
    public function __construct(
        private int    $id,
        private string $name
    )
    {
    }

    public static function create(int $id, string $name): self
    {
        return new self($id, $name);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }


}