<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Mooc\Infrastructure\Doctrine;

use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineEntityManagerFactory;
use function Lambdish\Phunctional\apply;

final class MoocEntityManagerFactory
{
    private static $namespace = 'CodelyTv\Context\Mooc\Module';
    private static $prefixes  = [
        'Video\Domain' => 'Module/Video/Infrastructure/Persistence',
        'User\Domain'  => 'Module/User/Infrastructure/Persistence',
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
