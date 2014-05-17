<?php

namespace Rssr\Tests;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class AtomFeedTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $log = new Logger('phpunit');
        $log->pushHandler(new StreamHandler('./phpunit.log', Logger::WARNING));

        $this->feed = new \Rssr\Feed\Atom(new \SimpleXMLElement(
            file_get_contents(__DIR__ . '/samples/atom.xml')));
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
        $this->assertEquals($this->feed->stories[0]->title, 'Atom-Powered Robots Run Amok');
    }

}