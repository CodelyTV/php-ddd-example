<?php

namespace CodelyTv\Context\Course\Infrastructure\Doctrine;

use CodelyTv\Infrastructure\Doctrine\DoctrineEntityManagerFactory;
use Doctrine\ORM\EntityManager;
use function Lambdish\Phunctional\apply;

final class CourseEntityManagerFactory
{
    private static $namespace = 'CodelyTv\Context\Course\Module';

    private static $prefixes = [
        'Course\Domain\Entity'             => 'Module/Course/Infrastructure/Persistence/Mapping/Entity',
        'Course\Domain\ValueObject'        => 'Module/Course/Infrastructure/Persistence/Mapping/ValueObject',
        'CourseOpinion\Domain\Entity'      => 'Module/CourseOpinion/Infrastructure/Persistence/Mapping/Entity',
        'CourseOpinion\Domain\ValueObject' => 'Module/CourseOpinion/Infrastructure/Persistence/Mapping/ValueObject',
    ];

    public static function create(array $parameters, $rootPath, $onDemand, $schemaFile): EntityManager
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
