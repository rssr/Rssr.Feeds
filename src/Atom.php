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

    public function addStory($child)
    {
        if ($child instanceof \SimpleXMLElement == false) {
            throw new \Exception('Children of atom feeds must be added with SimpleXMLElement objects');
        }
        $story = new AtomStory($child);
        $this->children->addItem($story);
        return $this;
    }

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
