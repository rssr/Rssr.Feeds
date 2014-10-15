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
 * ATOM implementation of the Feed class
 *
 * @package Rssr
 *
 */
class Atom extends AbstractFeed
{

    const FEED_TYPE = 'feed';

    protected $storyType = '\Rssr\Feed\AtomStory';

    /**
     * key map for feed data
     * @var Array
     */
    protected $getKeys = [
        'title'         => 'title',
        'link'          => 'link',
        'updateTime'    => 'updated',
        'summary'       => 'subtitle'
    ];

    /**
     * return the content
     *
     * @param  \SimpleXMLElement $xml
     * @return \SimpleXMLElement
     */
    protected function getContent(\SimpleXMLElement $xml)
    {
        return $xml;
    }

    /**
     * return stories
     *
     * @param  \SimpleXMLElement $xml
     * @return \SimpleXMLElement[]
     */
    protected function getChildren(\SimpleXMLElement $xml)
    {
        return $xml->entry;
    }

}
