<?php

namespace Rssr\Feed;

interface StoryInterface
{
    /**
     * get a value from storage
     * @param  mixed $key
     * @return mixed
     */
    public function __get($key);

    /**
     * set a value in storage
     * @param mixed $key
     * @param mixed $value
     */
    public function __set($key, $value);
}
