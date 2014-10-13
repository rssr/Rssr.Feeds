<?php

namespace Rssr\Feed;

interface CollectionInterface extends \IteratorAggregate, \Countable
{

    /**
     * return the iterator
     * @return \Traversable
     */
    public function getIterator();

    /**
     * return the count of items in collection
     * @return int
     */
    public function count();

    /**
     * Get the item at given index
     * @param int $index
     * @return \Rssr\Feed\FeedInterface
     */
    public function item($index);

    /**
     * Add an item to the collection
     * @param \Rssr\Feed\FeedInterface $value
     * @return \Rssr\Feed\CollectionInterface
     */
    public function append(\Rssr\Feed\FeedInterface $value);

}
