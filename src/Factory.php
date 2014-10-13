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
    protected $handlers = [];

    /**
     * Add a feed type that will normalize feed data
     * @param callable $handler
     */
    public function addHandler($handler)
    {
        $this->handlers[] = $handler;
    }

    /**
     * Initialize a new Feed
     * @param mixed $data
     * @return mixed
     */
    public function newFeed($data)
    {
        foreach ($this->handlers as $handler) {
            if ($resp = $handler::init($data)) {
                return $resp;
            }
        }

        return false;
    }
}
