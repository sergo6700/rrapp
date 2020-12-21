<?php

namespace Tests;

use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        static::startChromeDriver();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu',
            '--headless',
            '--window-size=1920,1080',
            '--no-sandbox',
//            '--ignore-ssl-errors',
//            '--disable-dev-shm-usage',
//            '--whitelisted-ips=""'
        ]);

        if (env('USE_SELENIUM', 'false')) {
            $seleniumServerUrl = 'http://chrome:9515';
        } else {
            $seleniumServerUrl = 'http://localhost:9515';
        }

        return RemoteWebDriver::create(
            $seleniumServerUrl, DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
        ));
    }
}
