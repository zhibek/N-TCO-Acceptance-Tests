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
        $element = $this->getSession()->getPage()->find('xpath', '*//*[@class = "'. $text .'"]');
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', $text));
        }

        $element->click();
    }

    /**
     * @When /^I click cookie button$/
     */
    public function iClickCookieButton()
    {
        $this->getSession()->switchToIFrame("qb_cookie_consent_main");

        $css = "div#buttonAccept";

        $element = $this->getSession()->getPage()->find('css', $css);

        // errors must not pass silently
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', $element));
        }

        $element->click();
    }

    /**
     * @When /^I should find "([^"]*)" on element "([^"]*)"$/
     */
    public function ishouldFindOnElement($text, $css)
    {
        $elements = $this->getSession()->getPage()->find('css', $css);
        // errors must not pass silently
        if (null === $elements) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', $element));
        }

        foreach ($elements as $element) {
            $elementText = $element->text();
            $pos = strpos($elementText, $text);
            if ($pos !== false) {
                return true;
            }
        }

    }

    /**
     * @When /^I find in table with id "([^"]*)" a row no "([^"]*)" in column no "([^"]*)" a text "([^"]*)"$/
     */
    public function iFindeInTableWithIdARowOfInColumnNoAValue($id, $recordNo, $elementNo, $text)
    {
        $table = "table#".$id;
        $elements = $this->getSession()->getPage()->find('css', $table)->find('css', "tr");
        // errors must not pass silently
        if (null === $elements) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', $element));
        }

        $i=0;

        foreach ($elements as $element) {
            $children = $elements->find('css', "td");
            if($children != null && $i = $recordNo){
                    $s=0;
                foreach ($children as $child) {
                    if($s = $elementNo){
                        $pos = strpos($child->text(), $text);
                        if ($pos !== false) {
                            return true;
                        }        

                    }
                    $s++;
                }
                
            }    
            $i++;
        }
        

        return false;

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