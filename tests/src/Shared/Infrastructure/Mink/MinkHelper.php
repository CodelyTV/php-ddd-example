<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\Mink;

use Behat\Mink\Driver\DriverInterface;
use Behat\Mink\Session;
use Behat\Symfony2Extension\Driver\KernelDriver;
use RuntimeException;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Request;
use function Lambdish\Phunctional\get_in;

final class MinkHelper
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function setRequestHeader($header, $value): void
    {
        $this->getClient()->setServerParameter($header, $value);
    }

    public function addRequestHttpBasicAuthentication($username, $password): void
    {
        $this->getClient()->setServerParameter('PHP_AUTH_USER', $username);
        $this->getClient()->setServerParameter('PHP_AUTH_PW', $password);
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

    public function getRequestHeaders(): array
    {
        return $this->normalizeHeaders($this->getRequest()->headers->all());
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

    public function responseShouldContain($needle): void
    {
        if (strpos($this->clearString($this->getResponse()), $this->clearString($needle)) === false) {
            throw new RuntimeException(sprintf('The response do not contain %s', $needle));
        }
    }

    public function responseShouldNotContain($needle): void
    {
        if (strpos($this->clearString($this->getResponse()), $this->clearString($needle)) === true) {
            throw new RuntimeException(sprintf('The response do not contain %s', $needle));
        }
    }

    public function hasResponseHeader($name): bool
    {
        return array_key_exists($name, $this->getResponseHeaders());
    }

    public function getResponseHeader($name)
    {
        return get_in([$name], $this->getResponseHeaders());
    }

    public function hasResponseParameter($name): bool
    {
        return array_key_exists($name, $this->getResponseParameters());
    }

    public function getResponseParameter($name)
    {
        return get_in([$name], $this->getResponseParameters());
    }

    public function resetServerParameters(): void
    {
        $this->getClient()->setServerParameters([]);
    }

    public function getNodeElementByXpath($query)
    {
        return $this->getSession()->getPage()->find('xpath', $query);
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

    private function getClient(): Client
    {
        return $this->getDriver()->getClient();
    }

    /** FIXME: The content can be different than json, check the content-type header */
    private function getResponseParameters()
    {
        return json_decode($this->getSession()->getPage()->getContent(), true);
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

    private function clearString($string)
    {
        return preg_replace('/\s+/S', ' ', $string);
    }
}
