<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\CoursesCounter\Application\Find;

use CodelyTv\OpenFlight\CoursesCounter\Domain\CoursesCounterNotExist;
use CodelyTv\OpenFlight\CoursesCounter\Domain\CoursesCounterRepository;

final class CoursesCounterFinder
{
    public function __construct(private CoursesCounterRepository $repository)
    {
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
