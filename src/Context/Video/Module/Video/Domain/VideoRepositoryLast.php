<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Domain;

interface VideoRepositoryLast
{
    public function searchLast(): ?Video;
}
