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
 * RSS 2.0 implementation of the Feed class
 *
 * @package Rssr
 * 
 */
class Rss extends AbstractFeed
{

    const FEED_TYPE = 'RSS';

    /**
     * key map for feed data
     * @var Array
     */
    protected $keys = [
        'title'         => 'title',
        'link'          => 'link',
        'updateTime'    => 'lastBuildDate',
        'summary'       => 'description',
    ];

    /**
     * key map for feed story data
     * @var Array
     */
    protected $storyKeys = [
        'title'         => 'title',
        'link'          => 'link',
        'id'            => 'guid',
        'updateTime'    => 'pubDate',
        'summary'       => 'description',
        'content'       => 'description',
        'author'        => '',
    ];

    /**
     * return the content
     * 
     * @param  SimpleXMLElement $xml
     * @return SimpleXMLElement
     */
    protected function getContent(SimpleXMLElement $xml)
    {
        return $xml->channel;
    }

    /**
     * return stories
     * 
     * @param  SimpleXMLElement $xml
     * @return Array<SimpleXMLElement>
     */
    protected function getChildren(SimpleXMLElement $xml)
    {
        return $xml->channel->item;
    }
}