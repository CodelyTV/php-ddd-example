<?php

namespace CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class CommandBusCompilerPass implements CompilerPassInterface
{
    const SERVICE_ID_WHERE_REGISTER_HANDLERS = 'codely.infrastructure.command_bus';

    private $tag;
    private $methodMapper;

    public function __construct($tag)
    {
        $this->tag          = $tag;
        $this->methodMapper = new CallableFirstParameterExtractor();
    }

    public function process(ContainerBuilder $container)
    {
        $commandBus        = $container->findDefinition(self::SERVICE_ID_WHERE_REGISTER_HANDLERS);
        $handlerServiceIds = array_keys($container->findTaggedServiceIds($this->tag));

        foreach ($handlerServiceIds as $id) {
            $commandHandler = $container->findDefinition($id);
            $this->registerHandler($commandHandler, $id, $commandBus);
        }
    }

    private function registerHandler(Definition $commandHandler, $handlerServiceId, Definition $commandBus)
    {
        $commandClass = $this->methodMapper->extract($commandHandler->getClass());

        $commandBus->addMethodCall('register', [$commandClass, new Reference($handlerServiceId)]);
    }
}
