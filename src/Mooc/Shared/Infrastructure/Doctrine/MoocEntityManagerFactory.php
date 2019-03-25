<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Shared\Infrastructure\Doctrine;

use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineEntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;
use function Lambdish\Phunctional\apply;

final class MoocEntityManagerFactory
{
    private static $namespace = 'CodelyTv\Mooc';
    private static $prefixes = [
        'Shared\Domain' => 'Shared/Infrastructure/Persistence',

        'Videos\Domain'   => 'Videos/Infrastructure/Persistence',
        'Students\Domain' => 'Students/Infrastructure/Persistence',
        'Steps\Domain'    => 'Steps/Infrastructure/Persistence',
    ];

    public static function create(array $parameters, $rootPath, $onDemand, $schemaFile): EntityManagerInterface
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
