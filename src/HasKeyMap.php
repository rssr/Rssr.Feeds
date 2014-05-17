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
 * Normalize access to Atom and RSS feeds and stories
 * 
 * @author Matthew Wells <matthewpaulwells@gmail.com>
 * @package Rssr
 */
trait HaskeyMap
{
    /**
     * key map
     * @var array
     */
    protected $keys = [];

    /**
     * XML data
     * @var \SimpleXMLElement
     */
    protected $data = null;

    /**
     * Access the data!
     * 
     * @param  string $key
     * @return SimpleXMLElement
     */
    public function __get($key)
    {
        if (!isset($this->keys[$key])) {

            return null;
        }

        $value = $this->keys[$key];

        if (is_callable($value)) {
            var_dump($value);

            return call_user_func($value);
        }

        return $this->data->{$value};
    }
}