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
class AtomStory implements StoryInterface
{
    use HasKeyMap;
    use InitsIdGetKey;

    /**
     * Initialize a Story
     * @param SimpleXMLElement $xml
     */
    public function __construct(SimpleXMLElement $xml)
    {
        $this->data = $xml;
        $this->getKeys = [
            'id'            => 'id',
            'title'         => 'title',
            'updateTime'    => 'updated',
            'summary'       => 'summary',
            'content'       => 'content',
            'author'        => '',
        ];

        $this->initIdKey($xml);

        $this->getKeys['link'] = function() use($xml)
        {
            return $xml->link['href'];
        };

       $this->getKeys['contentType'] = function() use($xml)
        {
            return $xml->content['type'];
        };
    }
}
