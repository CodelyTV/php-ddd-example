<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notification\Infrastructure\Persistence;

use CodelyTv\Mooc\Notification\Domain\Notification;
use CodelyTv\Mooc\Notification\Domain\NotificationId;
use CodelyTv\Mooc\Notification\Domain\NotificationRepository;
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
