<?php

namespace CodelyTv\Test\Infrastructure\Mink;

use Behat\Mink\Session;
use Behat\Symfony2Extension\Driver\KernelDriver;
use Exception;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\HttpFoundation\Request;
use function Lambdish\Phunctional\get_in;

final class MinkHelper
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function setRequestHeader($header, $value)
    {
        $this->getClient()->setServerParameter($header, $value);
    }

    public function addRequestHttpBasicAuthentication($username, $password)
    {
        $this->getClient()->setServerParameter('PHP_AUTH_USER', $username);
        $this->getClient()->setServerParameter('PHP_AUTH_PW', $password);
    }

    public function sendRequest($method, $url, array $optionalParams = [])
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

    public function getRequestHeaders()
    {
        return $this->normalizeHeaders($this->getRequest()->headers->all());
    }

    public function getResponse()
    {
        return $this->getSession()->getPage()->getContent();
    }

    public function getResponseHeaders()
    {
        return $this->normalizeHeaders(
            array_change_key_case($this->getSession()->getResponseHeaders(), CASE_LOWER)
        );
    }

    public function responseShouldContain($needle)
    {
        if (strpos($this->clearString($this->getResponse()), $this->clearString($needle)) === false) {
            throw new Exception(sprintf('The response do not contain %s', $needle));
        }
    }

    public function responseShouldNotContain($needle)
    {
        if (strpos($this->clearString($this->getResponse()), $this->clearString($needle)) === true) {
            throw new Exception(sprintf('The response do not contain %s', $needle));
        }
    }

    public function hasResponseHeader($name)
    {
        return array_key_exists($name, $this->getResponseHeaders());
    }

    public function getResponseHeader($name)
    {
        return get_in([$name], $this->getResponseHeaders());
    }

    public function hasResponseParameter($name)
    {
        return array_key_exists($name, $this->getResponseParameters());
    }

    public function getResponseParameter($name)
    {
        return get_in([$name], $this->getResponseParameters());
    }

    public function resetServerParameters()
    {
        $this->getClient()->setServerParameters([]);
    }

    public function getNodeElementByXpath($query)
    {
        return $this->getSession()->getPage()->find('xpath', $query);
    }

    /** @return Request $request */
    public function getRequest()
    {
        return $this->getClient()->getRequest();
    }

    private function getSession()
    {
        return $this->session;
    }

    /** @return KernelDriver */
    private function getDriver()
    {
        return $this->getSession()->getDriver();
    }

    /** @return Client */
    private function getClient()
    {
        return $this->getDriver()->getClient();
    }

    /** FIXME: The content can be different than json, check the content-type header */
    private function getResponseParameters()
    {
        return json_decode($this->getSession()->getPage()->getContent(), true);
    }

    private function normalizeHeaders(array $headers)
    {
        return array_map('implode', array_filter($headers));
    }

    private function resetRequestStuff()
    {
        $this->getSession()->reset();
        $this->resetServerParameters();
    }

    private function clearString($string)
    {
        return preg_replace('/\s+/S', ' ', $string);
    }
}
