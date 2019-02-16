<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\Behat\ApiContext;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;
use CodelyTv\Test\Shared\Infrastructure\Mink\MinkHelper;
use CodelyTv\Test\Shared\Infrastructure\Mink\MinkSessionRequestHelper;

final class ApiRequestContext extends RawMinkContext
{
    /** @var MinkSessionRequestHelper */
    private $sessionRequestHelper;

    /**
     * @Given I send a :method request to :url
     */
    public function iSendARequestTo($method, $url)
    {
        $this->getSessionRequestHelper()->sendRequest($method, $this->locatePath($url));
    }

    /**
     * @When I send a :method request to :url with the parameters:
     */
    public function iSendARequestToWithParameters($method, $url, TableNode $parameters)
    {
        $this->getSessionRequestHelper()->sendRequestWithTableNode($method, $this->locatePath($url), $parameters);
    }

    /**
     * @Given I send a :method request to :url with body:
     */
    public function iSendARequestToWithBody($method, $url, PyStringNode $body)
    {
        $this->getSessionRequestHelper()->sendRequestWithPyStringNode($method, $this->locatePath($url), $body);
    }

    /**
     * @When I add :name header equal to :value
     */
    public function iAddHeaderEqualTo($name, $value)
    {
        $this->getSessionRequestHelper()->addHeaderEqualTo($name, $value);
    }

    /**
     * @Then print request headers
     */
    public function printRequestHeaders()
    {
        $this->getSessionRequestHelper()->printRequestHeaders();
    }

    private function getSessionRequestHelper()
    {
        return $this->sessionRequestHelper = $this->sessionRequestHelper
            ?: new MinkSessionRequestHelper(new MinkHelper($this->getSession()));
    }
}
