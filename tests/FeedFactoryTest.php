<?php

namespace Rssr\Tests;

use SimpleXMLElement;

class FeedFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = new \Rssr\Feed\Factory;
    }

    public function testAtomCreation()
    {
        $xml = new SimpleXMLElement(
            file_get_contents(__DIR__ . '/samples/atom.xml'));
        $feed = $this->factory->newFeed($xml);

        $this->assertInstanceOf('\Rssr\Feed\Atom', $feed);
    }

    public function testRssCreation()
    {
        $xml = new SimpleXMLElement(
            file_get_contents(__DIR__ . '/samples/rss.xml'));
        $feed = $this->factory->newFeed($xml);

        $this->assertInstanceOf('\Rssr\Feed\Rss', $feed);
    }

}