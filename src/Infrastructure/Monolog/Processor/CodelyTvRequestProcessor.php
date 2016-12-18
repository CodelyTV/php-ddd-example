<?php

namespace CodelyTv\Infrastructure\Monolog\Processor;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use function Lambdish\Phunctional\any;

final class CodelyTvRequestProcessor
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function __invoke(array $record)
    {
        $request = $this->requestStack->getMasterRequest();

        return $request ? $this->addRequestInfo($record, $request) : $record;
    }

    private function addRequestInfo(array $record, Request $request)
    {
        $record['extra']['request']['method']     = $request->getMethod();
        $record['extra']['request']['url']        = $request->getUri();
        $record['extra']['request']['ip']         = $request->getClientIp();
        $record['extra']['request']['content']    = $this->hashToString($request->request->all());
        $record['extra']['request']['attributes'] = $this->hashToString($request->attributes->all());
        $record['extra']['request']['headers']    = $this->hashToString(array_filter($request->headers->all()));

        return $record;
    }

    private function hashToString(array $hash, $format = '%s: %s')
    {
        $elements = [];

        foreach ($hash as $key => $values) {
            $elements[] = $this->elementAsString($format, $key, $values);
        }

        return implode(', ', $elements);
    }

    private function elementAsString($format, $key, $values)
    {
        return sprintf($format, $key, is_array($values) ? $this->arrayElementAsString($values) : $values);
    }

    private function arrayElementAsString(array $values)
    {
        return $this->containsAnArray($values) ?
            sprintf('[%s]', $this->hashToString($values, '#%s: %s')) :
            implode(', ', $values);
    }

    private function containsAnArray(array $values)
    {
        return any($this->isArray(), $values);
    }

    private function isArray()
    {
        return function ($value) {
            return is_array($value);
        };
    }
}
