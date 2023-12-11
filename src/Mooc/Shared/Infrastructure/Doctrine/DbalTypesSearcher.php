<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Shared\Infrastructure\Doctrine;

use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\reduce;

final class DbalTypesSearcher
{
	private const MAPPINGS_PATH = 'Infrastructure/Persistence/Doctrine';

	public static function inPath(string $path, string $contextName): array
	{
		$possibleDbalDirectories = self::possibleDbalPaths($path);
		$dbalDirectories = filter(self::isExistingDbalPath(), $possibleDbalDirectories);

		return reduce(self::dbalClassesSearcher($contextName), $dbalDirectories, []);
	}

	private static function modulesInPath(string $path): array
	{
		return filter(
			static fn (string $possibleModule): bool => !in_array($possibleModule, ['.', '..'], true),
			scandir($path)
		);
	}

	private static function possibleDbalPaths(string $path): array
	{
		return map(
			static function (mixed $_unused, string $module) use ($path) {
				$mappingsPath = self::MAPPINGS_PATH;

				return realpath("$path/$module/$mappingsPath");
			},
			array_flip(self::modulesInPath($path))
		);
	}

	private static function isExistingDbalPath(): callable
	{
		return static fn (string $path): bool => !empty($path);
	}

	private static function dbalClassesSearcher(string $contextName): callable
	{
		return static function (array $totalNamespaces, string $path) use ($contextName): array {
			$possibleFiles = scandir($path);
			$files = filter(static fn (string $file): bool => str_ends_with($file, 'Type.php'), $possibleFiles);

			$namespaces = map(
				static function (string $file) use ($path, $contextName): string {
					$fullPath = "$path/$file";
					$splittedPath = explode("/src/$contextName/", $fullPath);

					$classWithoutPrefix = str_replace(['.php', '/'], ['', '\\'], $splittedPath[1]);

					return "CodelyTv\\$contextName\\$classWithoutPrefix";
				},
				$files
			);

			return array_merge($totalNamespaces, $namespaces);
		};
	}
}
