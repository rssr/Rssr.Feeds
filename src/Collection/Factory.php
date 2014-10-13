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
     * classname of handler
     * @var string
     */
    protected $handler = null;

    /**
     * Add a feed type that will normalize feed data
     * @param string $handler classname
     */
    public function setHandler($handler)
    {
        if (!class_exists($handler)) {
            throw new \Exception('Class "' . $handler . '" does not exist!');
        }

        $this->handler = $handler;
    }

    /**
     * Initialize a new Feed
     * @return object
     */
    public function newFeedCollection()
    {
        if (is_null($this->handler)) {
            return false;
        }

        return new $this->handler;
    }
}
