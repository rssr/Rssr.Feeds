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
 * Normalize access to feeds and stories
 *
 * @author Matthew Wells <matthewpaulwells@gmail.com>
 * @package Rssr
 */
trait HaskeyMap
{
    /**
     * __get key map
     * @var array
     */
    protected $getKeys = [];

    /**
     * __set key map
     * @var array
     */
    protected $setKeys = [];

    /**
     * XML data
     * @var \SimpleXMLElement
     */
    public $data = null;

    /**
     * Access the data!
     *
     * @param  string $key
     * @return SimpleXMLElement
     */
    public function __get($key)
    {
        if (!isset($this->getKeys[$key])) {
            return null;
        }

        $value = $this->getKeys[$key];

        if (gettype($value) === 'object' && is_callable($value)) {
            return $value($this);
        }

        return $this->data->{$value};
    }

    public function __set($key, $data)
    {
        if (!array_key_exists($key, $this->setKeys)) {
            return null;
        }

        $this->setKeys[$key] = $data;
    }

    /**
     * get access to the XML data for attribute access, etc.
     * @return mixed
     */
    public function getXml()
    {
        return $this->data;
    }
}
