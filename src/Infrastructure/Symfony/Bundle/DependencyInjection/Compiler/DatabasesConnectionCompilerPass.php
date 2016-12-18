<?php

namespace CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use function Lambdish\Phunctional\each;

final class DatabasesConnectionCompilerPass implements CompilerPassInterface
{
    const DATABASE_CONNECTIONS_SERVICE = 'codely.infrastructure.database_connections';

    private $tag;

    public function __construct(string $tag)
    {
        $this->tag = $tag;
    }

    public function process(ContainerBuilder $container)
    {
        $databasesConnectionsService = $container->findDefinition(self::DATABASE_CONNECTIONS_SERVICE);
        $databasesConnectionsIds     = $container->findTaggedServiceIds($this->tag);

        each($this->addDatabasesConnections($databasesConnectionsService, $container), $databasesConnectionsIds);
    }

    private function addDatabasesConnections(Definition $connectionsService, ContainerBuilder $container)
    {
        return function (array $attributes, string $databaseConnectionServiceId) use ($connectionsService, $container) {
            $connectionsService->addMethodCall(
                'set',
                [$databaseConnectionServiceId, new Reference($databaseConnectionServiceId)]
            );
        };
    }
}
