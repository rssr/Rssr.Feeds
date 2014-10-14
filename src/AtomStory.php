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

    /**
     * Initialize a Story
     * @param SimpleXMLElement $xml
     * @param array            $getKeys
     */
    public function __construct(SimpleXMLElement $xml)
    {
        $this->data = $xml;
        $this->getKeys = [
            'title'         => 'title',
            'updateTime'    => 'updated',
            'summary'       => 'summary',
            'content'       => 'content',
            'author'        => '',
        ];

        $this->getKeys['id'] = function () use($xml)
        {
            if (strlen((string)$xml->id)) {
                return (string)$xml->id;
            }

            return md5((string)$xml->title . (string)$xml->link);
        };

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