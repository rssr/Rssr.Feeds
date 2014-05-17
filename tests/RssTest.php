<?php

namespace Mpw\Tests;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class RssTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $log = new Logger('phpunit');
        $log->pushHandler(new StreamHandler('./phpunit.log', Logger::WARNING));

        $this->feed = new \Mpw\Parsser\Feed\Rss(new \SimpleXMLElement(
            file_get_contents(__DIR__ . '/samples/rss.xml')));
    }


    public function testUpdateTime()
    {
        $this->assertEquals($this->feed->updateTime, 'Mon, 06 Sep 2010 00:01:00 +0000 ');
    }

    public function testSummary()
    {
        $this->assertEquals($this->feed->summary, 'This is an example of an RSS feed');
    }

    public function testStoryTitle()
    {
        $this->assertEquals($this->feed->stories[0]->title, 'Example entry');
    }

}