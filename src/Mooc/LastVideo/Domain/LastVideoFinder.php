<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Domain;

final class LastVideoFinder
{
    public function __construct(private readonly LastVideoRepository $repository)
    {
    }

    public function __invoke(): LastVideo
    {
        $lastVideo = $this->repository->search();

        if (null === $lastVideo) {
            throw new LastVideoNotExist();
        }

        return $lastVideo;
    }
}
