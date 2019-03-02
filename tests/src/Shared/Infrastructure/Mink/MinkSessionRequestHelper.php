<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\Mink;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Symfony\Component\DomCrawler\Crawler;

final class MinkSessionRequestHelper
{
    /** @var MinkHelper */
    private $sessionHelper;

    public function __construct($sessionHelper)
    {
        $this->sessionHelper = $sessionHelper;
    }

    public function sendRequest($method, $url, array $optionalParams = []): void
    {
        $this->request($method, $url, $optionalParams);
    }

    /**
     * @todo : Fix parameters from hash, now is a simple solution
     */
    public function sendRequestWithTableNode($method, $url, TableNode $parameters): void
    {
        $this->request($method, $url, ['parameters' => $parameters->getRowsHash()]);
    }

    public function sendRequestWithPyStringNode($method, $url, PyStringNode $body): void
    {
        $this->request($method, $url, ['content' => $body->getRaw()]);
    }

    public function addHeaderEqualTo($name, $value): void
    {
        $this->sessionHelper->setRequestHeader($name, $value);
    }

    public function printRequestHeaders(): void
    {
        print_r($this->sessionHelper->getRequestHeaders());
    }

    public function request($method, $url, array $optionalParams = []): Crawler
    {
        return $this->sessionHelper->sendRequest($method, $url, $optionalParams);
    }

    public function addHttpBasicAuthentication($username, $password): void
    {
        $this->sessionHelper->addRequestHttpBasicAuthentication($username, $password);
    }
}
