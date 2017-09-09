<?php

declare (strict_types = 1);

namespace CodelyTv\Shared\Domain\Bus;

use ReflectionClass;
use ReflectionMethod;
use function CodelyTv\Utils\camel_to_snake;
use function CodelyTv\Utils\snake_to_camel;
use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\not;
use function Lambdish\Phunctional\reindex;

final class MessageSerializer
{
    public function __invoke(Request $message)
    {
        $reflected = new ReflectionClass($message);
        $methods   = $reflected->getMethods();

        $methodNames = reindex($this->methodNameExtractor(), $methods);

        return map($this->nameExtractor($message), filter(not($this->isConstruct()), $methodNames));
    }

    private function methodNameExtractor()
    {
        return function (ReflectionMethod $method) {
            return camel_to_snake($method->getName());
        };
    }

    private function nameExtractor(Request $message)
    {
        return function ($unused, $name) use ($message) {
            $methodName = snake_to_camel($name);

            return $message->$methodName();
        };
    }

    private function isConstruct()
    {
        return function ($unused, $name) {
            return $name === '__construct';
        };
    }
}
