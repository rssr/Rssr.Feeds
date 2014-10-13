<?php
/**
 *
 * Part of Rssr RSS reader for PHP
 *
 * @package Rssr
 * @license http://opensource.org/licenses/MIT MIT
 *
 */
namespace Rssr\Feed\Collection;

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
    protected $handler = null;

    /**
     * Add a feed type that will normalize feed data
     * @param callable $handler
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
    }

    /**
     * Initialize a new Feed
     * @param mixed $data
     * @return mixed
     */
    public function newFeedCollection()
    {
        if (is_null($this->handler)) {
            return false;
        }

        return new $this->handler;
    }
}
