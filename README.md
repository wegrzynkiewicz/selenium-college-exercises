# Selenium College Exercises

This application is for passing on college with Selenium WebDriver exercises

## How install?

First you need is download the selenium server
```
wget http://selenium-release.storage.googleapis.com/3.4/selenium-server-standalone-3.4.0.jar
```

And download and unzip ChromeWebDriver to execute test in Google Chrome Browser
```
wget https://chromedriver.storage.googleapis.com/2.30/chromedriver_linux64.zip
unzip chromedriver_linux64.zip
```

Then you can run selenium server with chrome driver
```
java -Dwebdriver.chrome.driver=./chromedriver -jar selenium-server-standalone-3.4.0.jar
```

Now install php dependencies via [composer](https://getcomposer.org/) 
```
composer install
```

## Running test
 
If you install all correct, you should run command
```
vendor/bin/phpunit SeleniumTest.php
```