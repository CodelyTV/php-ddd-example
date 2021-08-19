<?php

namespace CodelyTv\Backoffice\Courses\Application\LastVideo;

use CodelyTv\Backoffice\Courses\Application\BackofficeCourseResponse;
use CodelyTv\Backoffice\Courses\Domain\BackofficeCourseRepository;

class LastBackofficeCourseSearcher
{
    public function __construct(private BackofficeCourseRepository $repository)
    {
    }

    public function __invoke(): ?BackofficeCourseResponse
    {
        $lastCourse = $this->repository->lastCourse();

        if (!$lastCourse) {
            return null;
        }

        return new BackofficeCourseResponse(
            $lastCourse->id(),
            $lastCourse->name(),
            $lastCourse->duration()
        );
    }
}
