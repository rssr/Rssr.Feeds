<?php

namespace Rssr\Tests;

class FeedCollectionFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected function getFactory()
    {
        return new \Rssr\Feed\Collection\Factory;
    }

    public function testUnsetHandler()
    {
        $factory = $this->getFactory();

        $this->assertFalse($factory->newFeedCollection());
    }

    public function testStandardHandler()
    {
        $factory = $this->getFactory();
        $factory->setHandler('Rssr\Feed\Collection');

        $this->assertInstanceOf('Rssr\Feed\Collection', $factory->newFeedCollection());
    }
}
