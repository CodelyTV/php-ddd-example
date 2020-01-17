<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Shared\Infrastructure\Doctrine;

use CodelyTv\Shared\Domain\Utils;
use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\reduce;

final class DbalTypesSearcher
{
    private const MAPPINGS_PATH = 'Infrastructure/Persistence/Doctrine';

    public static function inPath(string $path, string $contextName): array
    {
        $possibleDbalDirectories = self::possibleDbalPaths($path);
        $dbalDirectories         = filter(self::isExistingDbalPath(), $possibleDbalDirectories);

        return reduce(self::dbalClassesSearcher($contextName), $dbalDirectories, []);
    }

    private static function modulesInPath(string $path): array
    {
        return filter(
            static function (string $possibleModule) {
                return !in_array($possibleModule, ['.', '..']);
            },
            scandir($path)
        );
    }

    private static function possibleDbalPaths(string $path): array
    {
        return map(
            static function ($unused, string $module) use ($path) {
                $mappingsPath = self::MAPPINGS_PATH;

                return realpath("$path/$module/$mappingsPath");
            },
            array_flip(self::modulesInPath($path))
        );
    }

    private static function isExistingDbalPath(): callable
    {
        return static function (string $path) {
            return !empty($path);
        };
    }

    private static function namespaceFormatter($baseNamespace): callable
    {
        return static function (string $path, string $module) use ($baseNamespace) {
            return "$baseNamespace\\$module\Domain";
        };
    }

    private static function dbalClassesSearcher(string $contextName): callable
    {
        return static function (array $totalNamespaces, string $path) use ($contextName) {
            $possibleFiles = scandir($path);
            $files         = filter(
                static function ($file) {
                    return Utils::endsWith('Type.php', $file);
                },
                $possibleFiles
            );

            $namespaces = map(
                static function (string $file) use ($path, $contextName) {
                    $fullPath     = "$path/$file";
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
