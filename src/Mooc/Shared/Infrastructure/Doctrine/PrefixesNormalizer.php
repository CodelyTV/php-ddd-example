<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Shared\Infrastructure\Doctrine;

final class PrefixesNormalizer
{
    private $path;
    private $namespacePrefix;

    public function __construct($path, $namespacePrefix = null)
    {
        $this->path            = $path;
        $this->namespacePrefix = $namespacePrefix ? $namespacePrefix . '\\' : '';
    }

    public function __invoke(array $prefixes)
    {
        $goodPrefixes = [];

        foreach ($prefixes as $className => $path) {
            $goodPrefixes[sprintf('%s/%s', $this->path, $path)] = sprintf('%s%s', $this->namespacePrefix, $className);
        }

        return $goodPrefixes;
    }
}
