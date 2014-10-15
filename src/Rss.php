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

    public function addStory($child)
    {
        if ($child instanceof \SimpleXMLElement == false) {
            throw new \Exception('Children of rss feeds must be added with SimpleXMLElement objects');
        }
        $story = new RssStory($child);
        $this->children->addItem($story);
        return $this;
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
