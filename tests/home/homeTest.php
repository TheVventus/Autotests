<?php

require 'tests/baseTest.php';
use Facebook\WebDriver\WebDriverBy;

class HomeTest extends BaseTest {

    public function test_searchTextOnGoogle() {
        $this->driver->get("https://www.google.com/ncr");
        $this->driver->manage()->window()->maximize();
        
        sleep(5);
        
        $element = $this->driver->findElement(WebDriverBy::name("q"));
        if($element) {
          $element->sendKeys("LambdaTest");
          $element->submit();
        }
        
        print $this->driver->getTitle();
        $this->assertEquals('LambdaTest - Google Search', $this->driver->getTitle());
      }

}