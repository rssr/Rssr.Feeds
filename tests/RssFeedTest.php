<?php

namespace Rssr\Tests;


class RssFeedTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->feed = new \Rssr\Feed\Rss(new \SimpleXMLElement(
            file_get_contents(__DIR__ . '/samples/rss.xml')));
    }

    public function testStoriesClass()
    {
        $this->assertInstanceOf('\Rssr\Feed\Story\Collection', $this->feed->stories);
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
        $data = $this->feed->stories->item('b82bc04efb1dc2ab7ee8a6754dadf0fc');
        $this->assertEquals($data->title, 'Example entry');
    }

    public function testStoryUpdateTime()
    {
        $data = $this->feed->stories->item('b82bc04efb1dc2ab7ee8a6754dadf0fc');
        $this->assertEquals('Mon, 06 Sep 2009 16:20:00 +0000', $data->updateTime);
    }

    public function testStoryLink()
    {
        $data = $this->feed->stories->item('b82bc04efb1dc2ab7ee8a6754dadf0fc');
        $this->assertEquals('http://www.wikipedia.org/', $data->link);
    }

    public function testAccessNonGuidStory()
    {
        $guid = md5('Example entry 2' . 'http://www.wikipedia.org/');

        $this->assertTrue(
            $this->feed->stories->item($guid) instanceof \Rssr\Feed\StoryInterface);
    }

}
