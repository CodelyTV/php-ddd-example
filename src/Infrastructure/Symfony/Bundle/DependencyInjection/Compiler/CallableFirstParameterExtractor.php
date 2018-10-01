<?php

namespace CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

use function Lambdish\Phunctional\reindex;
use ReflectionClass;
use ReflectionMethod;

final class CallableFirstParameterExtractor
{
    public function extract($class)
    {
        $reflector = new ReflectionClass($class);
        $method    = $reflector->getMethod('__invoke');

        if ($this->hasOnlyOneParameter($method)) {
            return $this->firstParameterClassFrom($method);
        }
    }

    public static function forCallables(iterable $callables): array
    {
        return reindex(self::classExtractor(new self()), $callables);
    }

    private function firstParameterClassFrom(ReflectionMethod $method)
    {
        return $method->getParameters()[0]->getClass()->getName();
    }

    private function hasOnlyOneParameter(ReflectionMethod $method)
    {
        return $method->getNumberOfParameters() === 1;
    }

    private static function classExtractor(CallableFirstParameterExtractor $parameterExtractor)
    {
        return function (callable $handler) use ($parameterExtractor) {
            return $parameterExtractor->extract($handler);
        };
    }
}
