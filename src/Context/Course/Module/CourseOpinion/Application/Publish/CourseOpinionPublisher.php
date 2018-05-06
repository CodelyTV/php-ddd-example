<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Application\Publish;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Repository\CourseOpinionRepository;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionId;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;

final class CourseOpinionPublisher
{
    private $repository;
    private $publisher;

    public function __construct(CourseOpinionRepository $repository, DomainEventPublisher $publisher)
    {
        $this->repository = $repository;
        $this->publisher  = $publisher;
    }

    /**
     * @param CourseOpinionId $id
     *
     * @throws \Exception
     */
    public function publish(CourseOpinionId $id): void
    {
        $opinion = $this->repository->findById($id);

        if (!$opinion) {
            throw new \InvalidArgumentException(
                sprintf('The course opinion %s does not exist', $id->value())
            );
        }

        $opinion->publish();

        $this->repository->save($opinion);

        $this->publisher->publish(...$opinion->pullDomainEvents());
    }
}
