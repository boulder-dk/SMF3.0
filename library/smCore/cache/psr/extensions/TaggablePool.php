<?php

/**
 * This file is part of the PSR Cache proposal with multiple cache interfaces.
 * Included in the smCore Cache component for information
 *  and eventual test implementations.
 * https://github.com/tedivm/fig-standards
 * @author tedivm
 */

namespace smCore\cache\psr\extensions;
use smCore\cache\psr\Pool;

/**
 * TaggablePool extends Cache Pool interface to provide tagging support.
 *
 * The TaggablePool interface adds support for returning
 * TaggableItem objects, as well as clearing the pool of tagged
 * Items.
 */

interface TaggablePool extends Pool
{
    /**
     * Clears the cache of all items with the specified tag.
     *
     * @param string $tag
     * @return bool
     */
    function clearByTag($tag);
}
