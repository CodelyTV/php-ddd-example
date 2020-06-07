<?php
declare(strict_types=1);


namespace CodelyTv\Mooc\Courses\Infrastructure;


interface Notifier
{
    public function publish(Notification $notification): void;
}
