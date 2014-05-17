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
    protected $types = [
        'feed'  => '\Rssr\Feed\Atom',
        'rss'   => '\Rssr\Feed\Rss',
    ];

    /**
     * Initialize a new Feed given a SimpleXMLElement
     * @param  SimpleXMLElement $xml
     * @return \Rssr\Feed\Abstract      (Won't actually be abstract, but a child class of it)
     */
    public function newFeed(SimpleXMLElement $xml)
    {
        if (!isset($this->types[$xml->getName()])) {
            throw new \Exception('Feed type ' . $xml->getName() . ' not supported!');
        }

        $className = $this->types[$xml->getName()];

        return new $className($xml);
    }
}