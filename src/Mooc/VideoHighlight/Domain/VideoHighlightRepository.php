<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoHighlight\Domain;

interface VideoHighlightRepository
{
    public function save(VideoHighlight $videoHighlight): void;

    public function search(VideoHighlightId $id): ?VideoHighlight;
}
