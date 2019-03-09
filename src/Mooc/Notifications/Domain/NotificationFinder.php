<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notifications\Domain;

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
