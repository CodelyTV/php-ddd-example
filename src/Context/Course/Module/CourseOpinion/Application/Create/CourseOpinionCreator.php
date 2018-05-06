<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Application\Create;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Entity\CourseOpinion;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Repository\CourseOpinionRepository;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionId;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionRating;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionText;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use CodelyTv\Shared\Domain\CourseId;

final class CourseOpinionCreator
{
    private $repository;
    private $publisher;

    public function __construct(CourseOpinionRepository $repository, DomainEventPublisher $publisher)
    {
        $this->repository = $repository;
        $this->publisher  = $publisher;
    }

    public function create(CourseId $courseId, CourseOpinionId $id, CourseOpinionRating $rating, CourseOpinionText $text): void
    {
        $opinion = CourseOpinion::create($courseId, $id, $rating, $text);

        $this->repository->save($opinion);

        $this->publisher->publish(...$opinion->pullDomainEvents());
    }
}
