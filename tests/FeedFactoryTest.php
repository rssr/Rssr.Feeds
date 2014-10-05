<?php

namespace Rssr\Tests;

use SimpleXMLElement;

class FeedFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->factory = new \Rssr\Feed\Factory;

    }

    public function tearDown()
    {
        unset($this->factory);
    }

    public function testAtomCreation()
    {
        $xml = new SimpleXMLElement(
            file_get_contents(__DIR__ . '/samples/atom.xml'));
       $this->factory->addFeedType('feed', function ($feedData)
        {
            return new \Rssr\Feed\Atom($feedData);
        });

        $feed = $this->factory->newFeed($xml);

        $this->assertInstanceOf('\Rssr\Feed\Atom', $feed);
    }

    public function testRssCreation()
    {
        $xml = new SimpleXMLElement(
            file_get_contents(__DIR__ . '/samples/rss.xml'));

        $this->factory->addFeedType('rss', function ($feedData)
        {
            return new \Rssr\Feed\Rss($feedData);
        });

        $feed = $this->factory->newFeed($xml);

        $this->assertInstanceOf('\Rssr\Feed\Rss', $feed);
    }

}