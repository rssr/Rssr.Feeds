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
 * Implementation of a Feed's Story
 * 
 * @author Matthew Wells <matthewpaulwells@gmail.com>
 * @package Rssr
 */
class Story
{
    use HasKeyMap;

    /**
     * Initialize a Story
     * @param SimpleXMLElement $xml
     * @param array            $keys
     */
    public function __construct(SimpleXMLElement $xml, array $keys)
    {
        $this->keys = $keys;
        $this->data = $xml;
    }
}