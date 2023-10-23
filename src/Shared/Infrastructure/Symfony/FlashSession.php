<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure\Symfony;

use CodelyTv\Shared\Domain\Utils;
use Symfony\Component\HttpFoundation\RequestStack;

final class FlashSession
{
	private static array $flashes = [];

	public function __construct(RequestStack $requestStack)
	{
		self::$flashes = Utils::dot($requestStack->getSession()->getFlashBag()->all());
	}

	public function get(string $key, $default = null)
	{
		if (array_key_exists($key, self::$flashes)) {
			return self::$flashes[$key];
		}

		if (array_key_exists($key . '.0', self::$flashes)) {
			return self::$flashes[$key . '.0'];
		}

		if (array_key_exists($key . '.0.0', self::$flashes)) {
			return self::$flashes[$key . '.0.0'];
		}

		return $default;
	}

	public function has(string $key): bool
	{
		return array_key_exists($key, self::$flashes)
			   || array_key_exists($key . '.0', self::$flashes)
			   || array_key_exists($key . '.0.0', self::$flashes);
	}
}
