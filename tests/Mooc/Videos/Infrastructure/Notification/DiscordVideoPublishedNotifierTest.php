<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Infrastructure\Notification;

use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Infrastructure\Notification\DiscordVideoPublishedNotifier;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

final class DiscordVideoPublishedNotifierTest extends TestCase
{
	private const WEBHOOK_URL = 'https://discord.test/api/webhooks/123/token';

	/** @test */
	public function it_should_post_the_video_to_the_webhook(): void
	{
		$response = new MockResponse('', ['http_code' => 204]);
		$notifier = new DiscordVideoPublishedNotifier(new MockHttpClient($response), self::WEBHOOK_URL);

		$notifier->notify(new VideoTitle('DDD en PHP'), new VideoUrl('https://codely.com/video'));

		$this->assertSame('POST', $response->getRequestMethod());
		$this->assertSame(self::WEBHOOK_URL, $response->getRequestUrl());

		$body = json_decode($response->getRequestOptions()['body'], true);
		$this->assertStringContainsString('DDD en PHP', $body['content']);
		$this->assertStringContainsString('https://codely.com/video', $body['content']);
	}

	/** @test */
	public function it_should_fail_when_the_webhook_returns_an_error(): void
	{
		$notifier = new DiscordVideoPublishedNotifier(
			new MockHttpClient(new MockResponse('', ['http_code' => 404])),
			self::WEBHOOK_URL
		);

		$this->expectException(ClientException::class);

		$notifier->notify(new VideoTitle('DDD en PHP'), new VideoUrl('https://codely.com/video'));
	}
}
