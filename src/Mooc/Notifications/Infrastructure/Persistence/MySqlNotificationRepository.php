<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notifications\Infrastructure\Persistence;

use CodelyTv\Mooc\Notifications\Domain\Notification;
use CodelyTv\Mooc\Notifications\Domain\NotificationId;
use CodelyTv\Mooc\Notifications\Domain\NotificationRepository;
use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineRepository;

final class MySqlNotificationRepository extends DoctrineRepository implements NotificationRepository
{
    public function search(NotificationId $id): ?Notification
    {
        return $this->repository(Notification::class)->find($id);
    }

    public function save(Notification $notification): void
    {
        $this->persist($notification);
    }
}
