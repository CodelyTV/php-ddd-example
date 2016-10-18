<?php

namespace CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

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

    private function firstParameterClassFrom(ReflectionMethod $method)
    {
        return $method->getParameters()[0]->getClass()->getName();
    }

    private function hasOnlyOneParameter(ReflectionMethod $method)
    {
        return $method->getNumberOfParameters() === 1;
    }
}
