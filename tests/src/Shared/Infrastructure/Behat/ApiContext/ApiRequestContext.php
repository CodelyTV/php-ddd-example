<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\Behat\ApiContext;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Session;
use Behat\MinkExtension\Context\RawMinkContext;
use CodelyTv\Test\Shared\Infrastructure\Mink\MinkHelper;
use CodelyTv\Test\Shared\Infrastructure\Mink\MinkSessionRequestHelper;

final class ApiRequestContext extends RawMinkContext
{
    private $sessionRequestHelper;
    private $minkSession;

    public function __construct(Session $minkSession)
    {
        $this->minkSession = $minkSession;
    }


    /**
     * @Given I send a :method request to :url
     */
    public function iSendARequestTo($method, $url): void
    {
        $this->getSessionRequestHelper()->sendRequest($method, $this->locatePath($url));
    }

    /**
     * @When I send a :method request to :url with the parameters:
     */
    public function iSendARequestToWithParameters($method, $url, TableNode $parameters): void
    {
        $this->getSessionRequestHelper()->sendRequestWithTableNode($method, $this->locatePath($url), $parameters);
    }

    /**
     * @Given I send a :method request to :url with body:
     */
    public function iSendARequestToWithBody($method, $url, PyStringNode $body): void
    {
        $this->getSessionRequestHelper()->sendRequestWithPyStringNode($method, $this->locatePath($url), $body);
    }

    /**
     * @When I add :name header equal to :value
     */
    public function iAddHeaderEqualTo($name, $value): void
    {
        $this->getSessionRequestHelper()->addHeaderEqualTo($name, $value);
    }

    /**
     * @Then print request headers
     */
    public function printRequestHeaders(): void
    {
        $this->getSessionRequestHelper()->printRequestHeaders();
    }

    private function getSessionRequestHelper(): MinkSessionRequestHelper
    {
        return $this->sessionRequestHelper = $this->sessionRequestHelper
            ?: new MinkSessionRequestHelper(new MinkHelper($this->minkSession));
    }
}
