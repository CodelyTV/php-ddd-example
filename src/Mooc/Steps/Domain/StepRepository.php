<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Domain;

interface StepRepository
{
    public function save(Step $step): void;
}
