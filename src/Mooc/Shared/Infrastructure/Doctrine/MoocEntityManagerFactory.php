<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Shared\Infrastructure\Doctrine;

use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineEntityManagerFactory;
use function Lambdish\Phunctional\apply;

final class MoocEntityManagerFactory
{
    private static $namespace = 'CodelyTv\Mooc';
    private static $prefixes  = [
        'Video\Domain' => 'Video/Infrastructure/Persistence',
        'Student\Domain'  => 'Student/Infrastructure/Persistence',
    ];

    public static function create(array $parameters, $rootPath, $onDemand, $schemaFile): \Doctrine\ORM\EntityManagerInterface
    {
        return DoctrineEntityManagerFactory::create(
            $parameters,
            self::getNormalizedPrefixes($rootPath),
            $onDemand,
            $schemaFile
        );
    }

    private static function getNormalizedPrefixes($rootPath)
    {
        return apply(new PrefixesNormalizer(realpath($rootPath), self::$namespace), [self::$prefixes]);
    }
}
