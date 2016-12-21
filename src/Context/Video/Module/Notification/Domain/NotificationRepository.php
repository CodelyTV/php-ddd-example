<?php

namespace CodelyTv\Context\Video\Module\Notification\Domain;

interface NotificationRepository
{
    /** @return Notification|null */
    public function search(NotificationId $id);

    /** @return void */
    public function save(Notification $notification);
}
