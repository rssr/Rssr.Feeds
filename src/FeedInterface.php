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

    /**
     * Validate data and return a new feed implementation
     * @param  mixed $data
     * @return \Rssr\Feed\FeedInterface
     */
    public static function init($data);

    /**
     * return the array of feed stories
     *
     * @return \Rssr\Feed\Stories
     */
    public function getStories();
}
