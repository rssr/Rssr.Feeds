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
 * Interface for Feed implementations
 *
 * @author Matthew Wells <matthewpaulwells@gmail.com>
 * @package Rssr
 */
interface FeedInterface
{
    public static function init($data);

    /**
     * return the array of feed stories
     *
     * @return Story\Collection
     */
    public function getStories();

    /**
     * Add a story
     * @param object $child
     * @return \Rssr\Feed\FeedInterface
     */
    public function addStory($child);
}
