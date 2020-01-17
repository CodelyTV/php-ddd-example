<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\CoursesCounter\Application\Find;

use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterNotExist;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterRepository;

final class CoursesCounterFinder
{
    private $repository;

    public function __construct(CoursesCounterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): CoursesCounterResponse
    {
        $counter = $this->repository->search();

        if (null === $counter) {
            throw new CoursesCounterNotExist();
        }

        return new CoursesCounterResponse($counter->total()->value());
    }
}
