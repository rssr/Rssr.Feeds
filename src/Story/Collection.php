<?php

namespace Rssr\Feed\Story;

class Collection implements \IteratorAggregate, \Countable
{
    /**
     * @var \ArrayIterator
     */
    protected $stories = null;

    public function __construct()
    {
        $this->stories = new \ArrayIterator;
    }

    /**
     * Get an iterator for the stories
     * @return \ArrayAccess
     */
    public function getIterator()
    {
        return $this->stories;
    }

    /**
     * Add an item to the collection
     * If overwrite is set false, never overwrite data
     * @param \Rssr\Feed\StoryInterface   $story
     * @param boolean $overrwite
     */
    public function addItem(\Rssr\Feed\StoryInterface $story, $overrwite = true)
    {
        $id = $story->id;
        if ($overrwite) {
            $this->stories[$id] = $story;
        } else {
            if (isset($this->stories[$id])) {
                throw new \Exception('That story is already in the feed!');
            }
            $this->stories[$id] = $story;
        }

        return $this;
    }

    /**
     * Return the number of stories collected
     * @return int
     */
    public function count()
    {
        return $this->stories->count();
    }

    /**
     * Get the item at given id
     * @param  string $id
     * @return \Rssr\Feed\StoryInterface|boolean
     */
    public function item($id)
    {
        if (isset($this->stories[$id])) {
            return $this->stories[$id];
        }

        return false;
    }
}
