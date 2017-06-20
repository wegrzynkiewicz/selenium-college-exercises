<?php

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

class WebTest extends PHPUnit_Framework_TestCase
{
    /** @var RemoteWebDriver */
    protected static $driver;

    public static function setUpBeforeClass()
    {
        $host = 'http://localhost:4444/wd/hub';

        $options = new ChromeOptions();
        $capabilities = DesiredCapabilities::chrome();
        $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);

        static::$driver = RemoteWebDriver::create($host, $capabilities);
    }

    public function testPingMoreleDotNetSite()
    {
        static::$driver->get("http://ping.eu/ns-whois/");
        static::$driver->findElement(WebDriverBy::name('host'))
            ->click()
            ->sendKeys('morele.net')
            ->submit();

        static::$driver->wait(4);
        $result = static::$driver->findElement(WebDriverBy::id('results'))
            ->getText();

        $this->assertRegExp('/Morele\.net Radek/i', $result);
    }

    public function testSingInMoreleDotNet()
    {
        static::$driver->get("http://morele.net");
        static::$driver->findElement(WebDriverBy::xpath("//*[contains(text(), 'Zaloguj się')]"))
            ->click();

        static::$driver->wait(4);

        static::$driver->findElement(WebDriverBy::name('_username'))
            ->click()
            ->sendKeys("testowy@mailinator.com");

        static::$driver->findElement(WebDriverBy::name('_password'))
            ->click()
            ->sendKeys("test1234");

        static::$driver->findElement(WebDriverBy::xpath("//*[contains(text(), 'Zaloguj się')]"))
            ->click();

        static::$driver->wait(4);

        $totalPrice = static::$driver->findElement(WebDriverBy::cssSelector("div.totalPrice"))
            ->getText();

        $this->assertEquals('1445,00 zł', $totalPrice);
    }
}