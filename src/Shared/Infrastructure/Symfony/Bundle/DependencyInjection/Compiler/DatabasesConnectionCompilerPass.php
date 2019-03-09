<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

use CodelyTv\Shared\Infrastructure\Doctrine\DatabaseConnections;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use function Lambdish\Phunctional\each;

final class DatabasesConnectionCompilerPass implements CompilerPassInterface
{
    public const DATABASE_CONNECTIONS_SERVICE = DatabaseConnections::class;
    private $tag;

    public function __construct(string $tag)
    {
        $this->tag = $tag;
    }

    public function process(ContainerBuilder $container): void
    {
        $databasesConnectionsService = $container->findDefinition(self::DATABASE_CONNECTIONS_SERVICE);
        $databasesConnectionsIds     = $container->findTaggedServiceIds($this->tag);

        each($this->addDatabasesConnections($databasesConnectionsService), $databasesConnectionsIds);
    }

    private function addDatabasesConnections(Definition $connectionsService): callable
    {
        return function (array $unused, string $databaseConnectionServiceId) use ($connectionsService): void {
            $connectionsService->addMethodCall(
                'set',
                [$databaseConnectionServiceId, new Reference($databaseConnectionServiceId)]
            );
        };
    }
}
