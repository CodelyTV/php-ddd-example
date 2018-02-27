<?php

namespace CodelyTv\Test\Infrastructure\Mink;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

final class MinkSessionRequestHelper
{
    /** @var MinkHelper */
    private $sessionHelper;

    public function __construct($sessionHelper)
    {
        $this->sessionHelper = $sessionHelper;
    }

    public function sendRequest($method, $url, array $optionalParams = [])
    {
        $this->request($method, $url, $optionalParams);
    }

    /**
     * @todo : Fix parameters from hash, now is a simple solution
     */
    public function sendRequestWithTableNode($method, $url, TableNode $parameters)
    {
        $this->request($method, $url, ['parameters' => $parameters->getRowsHash()]);
    }

    public function sendRequestWithPyStringNode($method, $url, PyStringNode $body)
    {
        $this->request($method, $url, ['content' => $body->getRaw()]);
    }

    public function addHeaderEqualTo($name, $value)
    {
        $this->sessionHelper->setRequestHeader($name, $value);
    }

    public function printRequestHeaders()
    {
        print_r($this->sessionHelper->getRequestHeaders());
    }

    public function request($method, $url, array $optionalParams = [])
    {
        return $this->sessionHelper->sendRequest($method, $url, $optionalParams);
    }

    public function addHttpBasicAuthentication($username, $password)
    {
        $this->sessionHelper->addRequestHttpBasicAuthentication($username, $password);
    }
}
