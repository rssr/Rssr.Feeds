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
class Stories implements \ArrayAccess
{

    protected $keys;
    protected $data;

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

}