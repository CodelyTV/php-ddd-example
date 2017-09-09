<?php

namespace CodelyTv\Context\Video\Module\Notification\Domain;

final class NotificationFinder
{
    private $repository;

    public function __construct(NotificationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(NotificationId $id): Notification
    {
        $notification = $this->repository->search($id);

        if (null === $notification) {
            throw new NotificationNotFound($id);
        }

        return $notification;
    }
}
