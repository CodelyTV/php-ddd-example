<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Domain;

interface LastVideoRepository
{
    public function save(LastVideo $lastVideo): void;

    public function search(): ?LastVideo;
}
