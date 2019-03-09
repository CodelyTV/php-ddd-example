<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoHighlights\Domain;

interface VideoHighlightRepository
{
    public function save(VideoHighlight $videoHighlight): void;

    public function search(VideoHighlightId $id): ?VideoHighlight;
}
