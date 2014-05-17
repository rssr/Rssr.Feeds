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
 * Abstract implementation of a Feed
 * 
 * @author Matthew Wells <matthewpaulwells@gmail.com>
 * @package Rssr
 */
abstract class AbstractFeed
{


    /**
     * key map (unset) for feed data
     * @var Array
     */
    protected $keys = [
        'title'         => '',
        'link'          => '',
        'updateTime'    => '',
        'summary'       => ''
    ];

    /**
     * key map (unset) for feed story data
     * @var Array
     */
    protected $storyKeys = [
        'title'         => '',
        'link'          => '',
        'id'            => '',
        'updateTime'    => '',
        'summary'       => '',
        'content'       => '',
        'author'        => '',
    ];

    /**
     * @var type of feed (unset)
     */
    const FEED_TYPE = '';

    /**
     * XML data storage
     * @var SimpleXMLElement
     */
    protected $data;

    /**
     * Stories!
     * @var Array<SimpleXMLElement>
     */
    protected $children = null;


    /**
     * Initialize a new Feed, given valid xml data
     * 
     * @param SimpleXMLElement $xml
     */
    public function __construct(\SimpleXMLElement $xml)
    {

        $this->data = $this->getContent($xml);
        $this->children = $this->getChildren($xml);
    }

    /**
     * return the element which "flattens" the Feed data to get title, description, updated time easily
     *
     *  @param  SimpleXMLElement $xml
     * @return SimpleXMLElement
     */
    abstract protected function getContent(\SimpleXMLElement $xml);

    /**
     * return the stories for the given `$xml` feed
     * 
     * @param  SimpleXMLElement $xml
     * @return Array<SimpleXMLElement>
     */
    abstract protected function getChildren(\SimpleXMLElement $xml);

    /**
     * return the array of feed stories
     * 
     * @return Array<SimpleXMLElement>
     */
    public function getStories()
    {
        return $this->children;
    }

    /**
     * Allow for simple access to data of the feed. Special case for 'stories' exists so that a method `getStories` needn't exist.
     * 
     * @param  String $index
     * @return mixed
     */
    public function __get($index)
    {

        if ($index === 'stories') {
            return $this->getStories();
        }

        if (!isset($this->keys[$index])) {
            return null;
        }

        $value = $this->data->{$this->keys[$index]};

        if ($value->count()) {
            return $value;
        }

        return null;
    }


}