<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notification\Infrastructure\Persistence;

use CodelyTv\Mooc\Notification\Domain\Notification;
use CodelyTv\Mooc\Notification\Domain\NotificationId;
use CodelyTv\Mooc\Notification\Domain\NotificationRepository;
use CodelyTv\Shared\Infrastructure\Doctrine\Repository;

final class MySqlNotificationRepository extends Repository implements NotificationRepository
{
    public function search(NotificationId $id)
    {
        return $this->repository(Notification::class)->find($id);
    }

    public function save(Notification $notification)
    {
        $this->persist($notification);
    }
}
