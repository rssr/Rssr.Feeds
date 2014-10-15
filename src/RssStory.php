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
    use InitsIdGetKey;

    /**
     * Initialize a Story
     * @param \SimpleXMLElement $xml
     */
    public function __construct(\SimpleXMLElement $xml)
    {
        $this->data = $xml;
        $this->getKeys = [
            'title'         => 'title',
            'link'          => 'link',
            'id'            => 'guid',
            'updateTime'    => 'pubDate',
            'summary'       => 'description',
            'content'       => 'description',
            'contentType'   => 'html',
            'author'        => '',
        ];

        $this->initIdKey($xml);
    }
}
