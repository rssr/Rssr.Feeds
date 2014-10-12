<?php

namespace Rssr\Tests;

use SimpleXMLElement;

class FeedFactoryTest extends \PHPUnit_Framework_TestCase
{

    protected function getFactory()
    {
        return new \Rssr\Feed\Factory;
    }

    public function testAtomCreation()
    {
        $data = file_get_contents(__DIR__ . '/samples/atom.xml');
        $factory = $this->getFactory();

        $factory->addHandler(\Rssr\Feed\Atom::class);
        $feed = $factory->newFeed($data);

        $this->assertInstanceOf('\Rssr\Feed\Atom', $feed);
    }

    public function testRssCreation()
    {
        $data = file_get_contents(__DIR__ . '/samples/rss.xml');
        $factory = $this->getFactory();
        $factory->addHandler('\Rssr\Feed\Rss');

        $feed = $factory->newFeed($data);

        $this->assertInstanceOf('\Rssr\Feed\Rss', $feed);
    }

    public function testNullData()
    {
        $data = null;
        $factory = $this->getFactory();
        $factory->addHandler('\Rssr\Feed\Rss');
        $factory->addHandler('\Rssr\Feed\Atom');

        $feed = $factory->newFeed($data);

        $this->assertFalse($feed);
    }

    public function testArrayData()
    {
        $data = [];
        $factory = $this->getFactory();
        $factory->addHandler('\Rssr\Feed\Rss');
        $factory->addHandler('\Rssr\Feed\Atom');

        $feed = $factory->newFeed($data);

        $this->assertFalse($feed);
    }

    public function testObjectData()
    {
        $data = new \stdClass;
        $factory = $this->getFactory();
        $factory->addHandler('\Rssr\Feed\Rss');
        $factory->addHandler('\Rssr\Feed\Atom');

        $feed = $factory->newFeed($data);

        $this->assertFalse($feed);
    }

}
