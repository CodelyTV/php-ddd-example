<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Shared\Infrastructure\Doctrine;

use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\reindex;

final class DoctrinePrefixesSearcher
{
    private const MAPPINGS_PATH = 'Infrastructure/Persistence/Doctrine';

    public static function inPath(string $path, string $baseNamespace): array
    {
        $possibleMappingDirectories = self::possibleMappingPaths($path);
        $mappingDirectories         = filter(self::isExistingMappingPath(), $possibleMappingDirectories);

        return array_flip(reindex(self::namespaceFormatter($baseNamespace), $mappingDirectories));
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

    private static function possibleMappingPaths(string $path): array
    {
        return map(
            static function ($unused, string $module) use ($path) {
                $mappingsPath = self::MAPPINGS_PATH;

                return realpath("$path/$module/$mappingsPath");
            },
            array_flip(self::modulesInPath($path))
        );
    }

    private static function isExistingMappingPath(): callable
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
}
