<?php

require 'vendor/autoload.php';
 
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Chrome\ChromeDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
 
class GoogleSearchChromeTest extends TestCase {
 
  protected $driver;

  public function build_chrome_capabilities() {
    $capabilities = DesiredCapabilities::chrome();

    // Здесь можно задать настройки для браузера
    $chromeOptions = new ChromeOptions();
    $chromeOptions->addArguments([
      '-headless'
    ]);
    $capabilities->setCapability(ChromeOptions::CAPABILITY, $chromeOptions);

    return $capabilities;
  }

  public function setUp(): void {
    $capabilities = $this->build_chrome_capabilities();
    /* Download the Selenium Server 3.141.59 from 
    https://selenium-release.storage.googleapis.com/3.141/selenium-server-standalone-3.141.59.jar
    */
    $this->driver = RemoteWebDriver::create('http://localhost:8090/wd/hub', $capabilities);
  }
 
  public function tearDown(): void {
    $this->driver->quit();
  }
  /*
  * @test
  */ 
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
 



