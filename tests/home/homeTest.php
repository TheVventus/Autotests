<?php

include 'helpers/baseTest.php';
include 'src/pages/home/homePage.php';
use Facebook\WebDriver\WebDriverBy;

class HomeTest extends BaseTest {

    /** @test */
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

    /** @test */
    public function testGoogleHome()
    {
        $this->googlesearchpage->openURL();
        $this->assertEquals('Google', $this->googlesearchpage->title());
    }

    /** @test */
    public function testGoogleSearch()
    {
        $this->googlesearchpage->openURL();
        $this->googlesearchpage->searchFor('Selenium');
        $this->assertTrue($this->searchresultspage->isSeleniumResultPresent(),'Selenium Result Found');
    }

}