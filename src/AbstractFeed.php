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

    protected $storyType = null;

    /**
     * @var type of feed (unset)
     */
    const FEED_TYPE = '';

    /**
     * Stories!
     * @var \Rssr\Feed\Story\Collection
     */
    protected $children = null;

    /**
     * {@inhertiDoc}
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
        $this->getKeys['stories'] = function()
        {
            return $this->children;
        };

        $this->data = $this->getContent($xml);

        $this->children = new Story\Collection;
        foreach ($this->getChildren($xml) as $child) {
            $this->addStory($child);
        }
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
     * {@inheritDoc}
     */
    public function addStory($child)
    {
        if ($child instanceof \SimpleXMLElement == false) {
            throw new \Exception('Children of feeds must be added with SimpleXMLElement objects');
        }
        $story = new $this->storyType($child);
        $this->children->addItem($story);
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getStories()
    {
        return $this->children;
    }


}
