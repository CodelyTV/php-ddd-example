<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Infrastructure\Notification;

use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\VideoPublishedNotifier;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class DiscordVideoPublishedNotifier implements VideoPublishedNotifier
{
	public function __construct(private HttpClientInterface $client, private string $webhookUrl) {}

	public function notify(VideoTitle $title, VideoUrl $url): void
	{
		$this->client->request('POST', $this->webhookUrl, [
			'json' => ['content' => sprintf('🎬 Nuevo vídeo publicado: **%s**%s%s', $title->value(), PHP_EOL, $url->value())],
		])->getContent();
	}
}
