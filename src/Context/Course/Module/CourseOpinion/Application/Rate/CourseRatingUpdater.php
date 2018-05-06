<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Application\Rate;

use CodelyTv\Context\Course\Module\Course\Domain\Repository\CourseRepository;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Repository\CourseOpinionRepository;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use CodelyTv\Shared\Domain\CourseId;

final class CourseRatingUpdater
{
    private $courseRepository;
    private $courseOpinionRepository;
    private $publisher;

    public function __construct(
        CourseRepository $courseRepository,
        CourseOpinionRepository $courseOpinionRepository,
        DomainEventPublisher $publisher
    )
    {
        $this->courseRepository        = $courseRepository;
        $this->courseOpinionRepository = $courseOpinionRepository;
        $this->publisher               = $publisher;
    }

    /**
     * @param CourseId $id
     *
     * @throws \Exception
     */
    public function updateRating(CourseId $id): void
    {
        $course = $this->courseRepository->findById($id);

        if (!$course) {
            throw new \InvalidArgumentException(
                sprintf('The course %s does not exist', $id->value())
            );
        }

        $course->updateRating(
            $this->courseOpinionRepository->getRating($course)
        );

        $this->courseRepository->save($course);

        $this->publisher->publish(...$course->pullDomainEvents());
    }
}
