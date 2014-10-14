<?php

namespace Rssr\Tests;

class AtomFeedTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->feed = new \Rssr\Feed\Atom(new \SimpleXMLElement(
            file_get_contents(__DIR__ . '/samples/atom.xml')));
    }

    public function testStoriesClass()
    {
        $this->assertInstanceOf('\Rssr\Feed\Story\Collection', $this->feed->stories);
    }

    public function testUpdateTime()
    {
        $this->assertEquals($this->feed->updateTime, '2003-12-13T18:30:02Z');
    }

    public function testSummary()
    {
        $this->assertEquals($this->feed->summary, 'A subtitle.');
    }

    public function testStoryTitle()
    {
        $data = $this->feed->stories->item('urn:uuid:1225c695-cfb8-4ebb-aaaa-80da344efa6a');
        $this->assertEquals($data->title, 'Atom-Powered Robots Run Amok');
    }

    public function testStoryUpdateTime()
    {
        $data = $this->feed->stories->item('urn:uuid:1225c695-cfb8-4ebb-aaaa-80da344efa6a');
        $this->assertEquals($data->updateTime, '2003-12-13T18:30:02Z');
    }

    public function testStoryLink()
    {
        $data = $this->feed->stories->item('urn:uuid:1225c695-cfb8-4ebb-aaaa-80da344efa6a');
        $this->assertEquals($data->link, 'http://example.org/2003/12/13/atom03');
    }

}
