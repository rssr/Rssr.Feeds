<?php

namespace Rssr\Tests;


class RssTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->feed = new \Rssr\Feed\Rss(new \SimpleXMLElement(
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