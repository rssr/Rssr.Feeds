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
        'contentType'   => '',
        'author'        => '',
    ];

    /**
     * Initialize the RSS feed
     *
     * @param \SimpleXMLElement $xml
     */
    public function __construct(SimpleXMLElement $xml)
    {
        $this->storyKeys['contentType'] = function()
        {
            return 'html';
        };

        parent::__construct($xml);
    }

    /**
     * Initialize (validate data and instantiate)
     * @param  mixed $data
     * @return mixed
     */
    public static function init($data)
    {
        $xml = parent::init($data);
        if (is_object($xml) &&
            $xml instanceof SimpleXMLElement &&
            $xml->getName() == 'rss') {
            return new \Rssr\Feed\Rss($xml);
        }

        return false;
    }

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
