<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;

use Behat\Mink\Driver\Selenium2Driver;

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{

    public static $referencedUrls = array();

    // see MinkContext for most step methods

    /**
     * @When /^I click button with title "([^"]*)"$/
     */
    public function iClickButtonWithTitle($text)
    {
        $this->getSession()->getPage()->find('xpath', '*//*[@title = "'. $text .'"]')->click();
    }

    /**
     * @When /^I click button with class "([^"]*)"$/
     */
    public function iClickButtonWithClass($text)
    {
        $this->getSession()->getPage()->find('xpath', '*//*[@class = "'. $text .'"]')->click();
    }

    /**
     * @When /^I click button with id "([^"]*)"$/
     */
    public function iClickButtonWithId($text)
    {
        $element = $this->getSession()->getPage()->find('css', "div#".$text);

        // errors must not pass silently
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', $locator));
        }
        $element->click();
    }    

    /**
     * @When /^I check "([^"]*)" radio button$/
     */
    public function iCheckRadioButton($text)
    {
        $this->getSession()->getPage()->find('xpath', '*//*[@id = "'. $text .'"]')->click();
    }

    /**
     * @When /^I add value with element "([^"]*)" value "([^"]*)"$/
     */
    public function iAddValueWithElement($element, $value)
    {
        $this->getSession()->getPage()->find('xpath', '*//input[contains(@class, "'. $element .'")]')->setValue($value);
    }


    /**
     * @When /^I select "([^"]*)" in element "([^"]*)"$/
     */
    public function iSelectInElement( $value, $element)
    {
        $this->getSession()->getPage()->find('xpath', '*//select[contains(@id, "'. $element .'")]')->selectOption($value);
    }


    /**
     * @When /^I wait for "([0-9+]*)" seconds$/
     */
    public function iWait($seconds)
    {
        $this->getSession()->wait($seconds * 1000);
    }

}