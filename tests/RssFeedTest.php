<?php

namespace Rssr\Tests;


class RssTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->feed = new \Rssr\Feed\Rss(new \SimpleXMLElement(
            file_get_contents(__DIR__ . '/samples/rss.xml')));
    }

    public function testStoriesClass()
    {
        $this->assertInstanceOf('\Rssr\Feed\Stories', $this->feed->stories);
    }

    public function testUpdateTime()
    {
        $this->assertEquals($this->feed->updateTime, 'Mon, 06 Sep 2010 00:01:00 +0000');
    }

    public function testSummary()
    {
        $this->assertEquals($this->feed->summary, 'This is an example of an RSS feed');
    }

    public function testStoryTitle()
    {
        $this->assertEquals($this->feed->stories[0]->title, 'Example entry');
    }

    public function testStoryUpdateTime()
    {
        $this->assertEquals($this->feed->stories[0]->updateTime, 'Mon, 06 Sep 2009 16:20:00 +0000');
    }

    public function testStoryLink()
    {
        $this->assertEquals($this->feed->stories[0]->link, 'http://www.wikipedia.org/');
    }

}
