<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Domain;

final class Steps
{
    private $steps;

    public function __construct(Step ...$steps)
    {
        $this->steps = $steps;
    }

}
