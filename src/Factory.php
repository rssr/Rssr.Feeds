<?php
/**
 *
 * Part of Rssr RSS reader for PHP
 *
 * @package Rssr
 * @license http://opensource.org/licenses/MIT MIT
 *
 */
namespace Rssr\Feed;

use SimpleXMLElement;

/**
 *
 * Factory class for generating the proper class given an XML feed.
 *
 * @package  Rssr
 *
 */
class Factory
{
    /**
     * map of root XML nodes to class names
     * @var Array
     */
    protected $types = [];

    /**
     * Add a feed type that will normalize feed data
     * @param string $type
     * @param callable $handler
     */
    public function addFeedType($type, callable $handler)
    {
        $this->types[$type] = $handler;
    }

    /**
     * Initialize a new Feed given a SimpleXMLElement
     * @param  $xml     String or SimpleXMLElement
     * @return \Rssr\Feed\Abstract      (Won't actually be abstract, but a child class of it)
     */
    public function newFeed($xml)
    {
        if (!$xml instanceof SimpleXMLElement) {
            $xml = simplexml_load_string($xml);
        }

        if (!isset($this->types[$xml->getName()])) {
            throw new \Exception('Feed type ' . $xml->getName() . ' not supported!');
        }

        $handler = $this->types[$xml->getName()];

        return $handler($xml);
    }
}