<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Application\Notify;

use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Application\Notify\NotifyOnVideoCreated;
use CodelyTv\Mooc\Videos\Application\Notify\VideoPublishedNotificator;
use CodelyTv\Mooc\Videos\Domain\VideoPublishedNotifier;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoCreatedDomainEventMother;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

final class NotifyOnVideoCreatedTest extends UnitTestCase
{
	private MockInterface | VideoPublishedNotifier | null $notifier;
	private NotifyOnVideoCreated | null $subscriber;

	protected function setUp(): void
	{
		parent::setUp();

		$this->notifier = $this->mock(VideoPublishedNotifier::class);
		$this->subscriber = new NotifyOnVideoCreated(new VideoPublishedNotificator($this->notifier));
	}

	/** @test */
	public function it_should_notify_a_published_video(): void
	{
		$event = VideoCreatedDomainEventMother::create();

		$this->notifier
			->shouldReceive('notify')
			->once()
			->with($this->similarTo(new VideoTitle($event->title())), $this->similarTo(new VideoUrl($event->url())))
			->andReturnNull();

		$this->notify($event, $this->subscriber);
	}
}
