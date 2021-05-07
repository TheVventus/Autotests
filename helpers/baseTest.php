<?php

require 'vendor/autoload.php';

 
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Chrome\ChromeDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
 
class BaseTest extends TestCase {

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
      $this->driver = RemoteWebDriver::create('http://localhost:8090/wd/hub', $capabilities);
    }
   
    public function tearDown(): void {
      $this->driver->quit();
    }
}