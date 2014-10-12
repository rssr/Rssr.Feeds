<?php

namespace Rssr\Feed;

interface FeedInterface
{
    public static function init($data);

    /**
     * return the array of feed stories
     *
     * @return \SimpleXMLElement[]
     */
    public function getStories();
}
