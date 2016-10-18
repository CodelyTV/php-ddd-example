<?php

namespace CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class OracleCompilerPass implements CompilerPassInterface
{
    const SERVICE_ID_WHERE_REGISTER_HANDLERS = 'codely.infrastructure.oracle';

    private $tag;
    private $methodMapper;

    public function __construct($tag)
    {
        $this->tag          = $tag;
        $this->methodMapper = new CallableFirstParameterExtractor();
    }

    public function process(ContainerBuilder $container)
    {
        $oracle            = $container->findDefinition(self::SERVICE_ID_WHERE_REGISTER_HANDLERS);
        $handlerServiceIds = array_keys($container->findTaggedServiceIds($this->tag));

        foreach ($handlerServiceIds as $id) {
            $queryHandler = $container->findDefinition($id);
            $this->registerHandler($queryHandler, $id, $oracle);
        }
    }

    private function registerHandler(Definition $queryHandler, $handlerServiceId, Definition $oracle)
    {
        $queryClass = $this->methodMapper->extract($queryHandler->getClass());

        $oracle->addMethodCall('register', [$queryClass, new Reference($handlerServiceId)]);
    }
}
