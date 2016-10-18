<?php

namespace CodelyTv\Context\Meetup\Infrastructure\Doctrine;

use CodelyTv\Infrastructure\Doctrine\DoctrineEntityManagerFactory;
use function Lambdish\Phunctional\apply;

final class ProductEntityManagerFactory
{
    private static $namespace = 'CodelyTv\Context\Meetup\Module';
    private static $prefixes  = [
    ];

    public static function create(array $parameters, $rootPath, $onDemand, $schemaFile)
    {
        return DoctrineEntityManagerFactory::create(
            $parameters,
            self::getNormalizedPrefixes($rootPath),
            $onDemand,
            $schemaFile
        );
    }

    private static function getNormalizedPrefixes($analyticsContextRootPath)
    {
        return apply(new PrefixesNormalizer(realpath($analyticsContextRootPath), self::$namespace), [self::$prefixes]);
    }
}
