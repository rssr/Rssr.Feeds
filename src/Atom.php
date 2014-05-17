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
 * ATOM implementation of the Feed class
 *
 * @package Rssr
 * 
 */
class Atom extends AbstractFeed
{

    const FEED_TYPE = 'Atom';

    /**
     * key map for feed data
     * @var Array
     */
    protected $keys = [
        'title'         => 'title',
        'link'          => 'link',
        'updateTime'    => 'updated',
        'summary'       => 'subtitle'
    ];

    /**
     * key map for feed story data
     * @var Array
     */
    protected $storyKeys = [
        'title'         => 'title',
        'link'          => 'link',
        'id'            => 'id',
        'updateTime'    => 'updated',
        'summary'       => 'summary',
        'content'       => 'content',
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
        return $xml;
    }

    /**
     * return stories
     * 
     * @param  SimpleXMLElement $xml
     * @return Array<SimpleXMLElement>
     */
    protected function getChildren(SimpleXMLElement $xml)
    {
        return $xml->entry;
    }

}