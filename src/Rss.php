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
 * RSS 2.0 implementation of the Feed class
 *
 * @package Rssr
 *
 */
class Rss extends AbstractFeed
{

    const FEED_TYPE = 'rss';

    protected $storyType = '\Rssr\Feed\RssStory';

    /**
     * key map for feed data
     * @var Array
     */
    protected $getKeys = [
        'title'         => 'title',
        'link'          => 'link',
        'updateTime'    => 'lastBuildDate',
        'summary'       => 'description',
    ];

    /**
     * return the content
     *
     * @param  \SimpleXMLElement $xml
     * @return \SimpleXMLElement
     */
    protected function getContent(\SimpleXMLElement $xml)
    {
        return $xml->channel;
    }

    /**
     * return stories
     *
     * @param  \SimpleXMLElement $xml
     * @return \SimpleXMLElement[]
     */
    protected function getChildren(\SimpleXMLElement $xml)
    {
        return $xml->channel->item;
    }
}
