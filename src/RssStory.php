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
 * Implementation of a Feed's Story
 *
 * @author Matthew Wells <matthewpaulwells@gmail.com>
 * @package Rssr
 */
class RssStory implements StoryInterface
{
    use HasKeyMap;

    /**
     * Initialize a Story
     * @param \SimpleXMLElement $xml
     * @param array            $getKeys
     */
    public function __construct(\SimpleXMLElement $xml)
    {
        $this->data = $xml;
        $this->getKeys = [
            'title'         => 'title',
            'link'          => 'link',
            'updateTime'    => 'pubDate',
            'summary'       => 'description',
            'content'       => 'description',
            'contentType'   => 'html',
            'author'        => '',
        ];

        $this->getKeys['id'] = function () use($xml)
        {
            if (strlen((string)$xml->guid)) {
                return (string)$xml->guid;
            }

            return md5((string)$xml->title . (string)$xml->link);
        };
    }
}
