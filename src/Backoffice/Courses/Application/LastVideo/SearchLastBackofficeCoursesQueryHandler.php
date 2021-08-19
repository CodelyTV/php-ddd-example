<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Courses\Application\LastVideo;

use CodelyTv\Backoffice\Courses\Application\BackofficeCoursesResponse;
use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;

final class SearchLastBackofficeCoursesQueryHandler implements QueryHandler
{
    public function __construct(private LastBackofficeCourseSearcher $searcher)
    {
    }

    public function __invoke(): ?BackofficeCoursesResponse
    {
        return $this->searcher->__invoke();
    }
}
