<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Notify;

use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\VideoCreatedDomainEvent;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;

final readonly class NotifyOnVideoCreated implements DomainEventSubscriber
{
	public function __construct(private VideoPublishedNotificator $notificator) {}

	public static function subscribedTo(): array
	{
		return [VideoCreatedDomainEvent::class];
	}

	public function __invoke(VideoCreatedDomainEvent $event): void
	{
		($this->notificator)(new VideoTitle($event->title()), new VideoUrl($event->url()));
	}
}
