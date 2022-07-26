<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\Notification\Notification;
use CodelyTv\Shared\Domain\Notification\Notificator;

final class VideoNotificationSender
{
    public function __construct(private readonly Notificator $notificator) {}

    public function videoCreated(Video $video): void
    {
        $this->notificator->notify(
            new Notification("A new video has been published: " . $video->title()->value() . ". Check it out!")
        );
    }
}
