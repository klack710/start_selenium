<?php

namespace Script;

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverDimension;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverExpectedCondition;

/**
 * @property RemoteWebDriver driver
 */
class Test extends TestCase
{
    const WINDOW_HEIGHT = 900;
    const WINDOW_WIDTH = 1080;
    const SELENIUM_SERVER_HOST = "http://selenium-chrome:4444/wd/hub";

    protected $driver;

    public function testSelenium()
    {
        // ドライバーを生成
        $this->driver = RemoteWebDriver::create(self::SELENIUM_SERVER_HOST, DesiredCapabilities::chrome());

        // ブラウザの設定
        $this->driver->manage()->window()->setSize(new WebDriverDimension(self::WINDOW_WIDTH, self::WINDOW_HEIGHT));

        // 接続
        $this->driver->get("https://www.nyamucoro.com/");
        $this->driver->wait(20, 100)->until(
            WebDriverExpectedCondition::titleIs('エンジニアのひよこ_level10')
        );

        //titleの取得
        $title = $this->driver->findElement(WebDriverBy::cssSelector('#title'))->getText();

        // データの確認
        $this->assertEquals("エンジニアのひよこ_level10",$title);
        $this->driver->quit();
    }
}