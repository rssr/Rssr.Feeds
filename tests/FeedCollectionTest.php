<?php

namespace Rssr\Tests;

use SimpleXMLElement;
use Mockery as m;

class FeedCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function getFeedCollection()
    {
        return new \Rssr\Feed\Collection;
    }

    public function testEmptyCollection()
    {
        $collection = $this->getFeedCollection();

        $this->assertEquals(0, $collection->count());
    }

    public function testAppend()
    {
        $collection = $this->getFeedCollection();
        $collection->append(m::mock('Rssr\Feed\FeedInterface'));

        $this->assertEquals(1, $collection->count());
    }

    public function testAccessItem()
    {
        $collection = $this->getFeedCollection();
        $collection->append(m::mock('Rssr\Feed\FeedInterface'));

        $this->assertInstanceOf('Rssr\Feed\FeedInterface', $collection->item(0));
    }

    public function testAppendIncompatibleValue()
    {
        $collection = $this->getFeedCollection();
        try {
            $collection->append(null);
            $this->assertTrue(false);
        } catch(\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testIteration()
    {
        $collection = $this->getFeedCollection();
        $collection->append(m::mock('Rssr\Feed\FeedInterface'));
        $collection->append(m::mock('Rssr\Feed\FeedInterface'));

        $iterations = 0;
        foreach ($collection as $item) {
            $iterations++;
        }

        $this->assertEquals(2, $iterations);
    }
}
