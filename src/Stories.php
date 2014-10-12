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
 * Implementation of a Feed's Stories
 *
 * @author Matthew Wells <matthewpaulwells@gmail.com>
 * @package Rssr
 */
class Stories implements \ArrayAccess, \Iterator
{

    protected $keys;
    protected $data;
    protected $storyIndex;

    /**
     * this is filled lazily
     * @var Array<Rssr\Feed\Story>
     */
    protected $cachedData = null;

    /**
     * Initialize a feed story
     * @param \SimpleXMLElement $xml
     * @param array            $keys
     */
    public function __construct(SimpleXMLElement $xml, array $keys)
    {
        $this->keys = $keys;
        $this->data = $xml;
    }

    /**
     * Required for \ArrayAccess implementation
     * @param  $offset
     * @param  $value
     */
    public function offsetSet($offset, $value)
    {}

    /**
     * Does the story exist?
     * @param  mixed $offset
     * @return SimpleXMLElement
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * Unused. Required by \ArrayAccess implementation
     * @param  mixed $offset
     */
    public function offsetUnset($offset)
    {}

    /**
     * Get the offset
     * @param  mixed $offset
     * @return \SimpleXMLElement
     */
    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return new Story($this->data[$offset], $this->keys);
        }

        return null;
    }

    /**
     * Return the current item in the iteration
     * @return \Rssr\Feed\Story
     */
    public function current()
    {
        return $this->offsetGet($this->storyIndex);
    }

    /**
     * Return the current index in the iteration
     * @return int
     */
    public function key()
    {
        return $this->storyIndex;
    }

    /**
     * Increment the iterator index
     */
    public function next()
    {
        $this->storyIndex += 1;
    }

    /**
     * Reset the iterator index
     */
    public function rewind()
    {
        $this->storyIndex = 0;
    }

    /**
     * Return the validity of the current iterator index
     * @return Boolean
     */
    public function valid()
    {
        return $this->offsetExists($this->key());
    }


}
