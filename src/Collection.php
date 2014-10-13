<?php

namespace Rssr\Feed;

class Collection implements CollectionInterface
{

    /**
     * @var \Rssr\Feed\FeedInterface[]
     */
    protected $data = [];

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * {@inheritDoc}
     */
    public function item($index)
    {
        return $this->data[$index];
    }

    /**
     * {@inheritDoc}
     */
    public function append(\Rssr\Feed\FeedInterface $value)
    {
        $this->data[] = $value;
        return $this;
    }
}
