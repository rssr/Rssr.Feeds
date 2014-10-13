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
abstract class AbstractFeed implements FeedInterface
{
    use HasKeyMap;


    /**
     * @var type of feed (unset)
     */
    const FEED_TYPE = '';


    /**
     * key map (unset) for feed story data
     * @var array
     */
    protected $storyKeys = [];


    /**
     * Stories!
     * @var \Rssr\Feed\Stories
     */
    protected $children = null;

    /**
     * initialize the data
     * @param  mixed $data
     * @return mixed
     */
    public static function init($data)
    {
        if (!is_string($data)) {
            return false;
        }

        $xml = simplexml_load_string($data);

        if (is_object($xml) &&
            $xml instanceof \SimpleXMLElement &&
            $xml->getName() == static::FEED_TYPE) {
            $className = get_called_class();
            return new $className($xml);
        }

        return false;
    }


    /**
     * Initialize a new Feed, given valid xml data
     *
     * @param \SimpleXMLElement $xml
     */
    public function __construct(\SimpleXMLElement $xml)
    {
        $this->keys['stories'] = function()
            {
                return $this->children;
            };


        $this->data = $this->getContent($xml);
        $this->children = new Stories($this->getChildren($xml), $this->storyKeys);
    }


    /**
     * return the element which "flattens" the Feed data to get title, description, updated time easily
     *
     *  @param  \SimpleXMLElement $xml
     * @return \SimpleXMLElement
     */
    abstract protected function getContent(\SimpleXMLElement $xml);


    /**
     * return the stories for the given `$xml` feed
     *
     * @param  \SimpleXMLElement $xml
     * @return \SimpleXMLElement[]
     */
    abstract protected function getChildren(\SimpleXMLElement $xml);


    /**
     * return the array of feed stories
     *
     * @return \Rssr\Feed\Stories
     */
    public function getStories()
    {
        return $this->children;
    }


}
