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
        'link'          => '',
        'id'            => 'id',
        'updateTime'    => 'updated',
        'summary'       => 'summary',
        'content'       => 'content',
        'contentType'   => '',
        'author'        => '',
    ];

    /**
     * Initialize an Atom feed
     *
     * @param \SimpleXMLElement $xml
     */
    public function __construct(\SimpleXMLElement $xml)
    {

        $this->storyKeys['link'] = function($scope)
        {
            return $scope->getXml()->link['href'];
        };

        $this->storyKeys['contentType'] = function($scope)
        {
            return $scope->getXml()->content['type'];
        };

        parent::__construct($xml);
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
