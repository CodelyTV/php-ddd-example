<?php

use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class NotifyOnVideoCreated implements DomainEventSubscriber {

    private $notifier;

    public function __construct(private VideoNotifier $videoNotifier)
    {
        $this->notifier = $videoNotifier;
    }

    public static function subscribedTo(): array
    {
        return [VideoCreatedDomainEvent::class];
    }

    public function __invoke(NotifyPublishedVideo $event) {
        $videoId = new VideoId($event->aggregateId());

        $this->notifier->save("Your video has been $videoId published");
    }
}