<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Shared\Infrastructure\Mink;

use Behat\Mink\Driver\DriverInterface;
use Behat\Mink\Session;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Request;

final class MinkHelper
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function sendRequest($method, $url, array $optionalParams = []): Crawler
    {
        $defaultOptionalParams = [
            'parameters'    => [],
            'files'         => [],
            'server'        => ['HTTP_ACCEPT' => 'application/json', 'CONTENT_TYPE' => 'application/json'],
            'content'       => null,
            'changeHistory' => true,
        ];

        $optionalParams = array_merge($defaultOptionalParams, $optionalParams);

        $crawler = $this->getClient()->request(
            $method,
            $url,
            $optionalParams['parameters'],
            $optionalParams['files'],
            $optionalParams['server'],
            $optionalParams['content'],
            $optionalParams['changeHistory']
        );

        $this->resetRequestStuff();

        return $crawler;
    }

    public function getResponse(): string
    {
        return $this->getSession()->getPage()->getContent();
    }

    public function getResponseHeaders(): array
    {
        return $this->normalizeHeaders(
            array_change_key_case($this->getSession()->getResponseHeaders(), CASE_LOWER)
        );
    }

    public function resetServerParameters(): void
    {
        $this->getClient()->setServerParameters([]);
    }

    public function getRequest(): Request
    {
        return $this->getClient()->getRequest();
    }

    private function getSession(): Session
    {
        return $this->session;
    }

    private function getDriver(): DriverInterface
    {
        return $this->getSession()->getDriver();
    }

    private function getClient(): AbstractBrowser
    {
        return $this->getDriver()->getClient();
    }

    private function normalizeHeaders(array $headers): array
    {
        return array_map('implode', array_filter($headers));
    }

    private function resetRequestStuff(): void
    {
        $this->getSession()->reset();
        $this->resetServerParameters();
    }
}
