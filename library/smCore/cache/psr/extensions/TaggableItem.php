<?php

/**
 * This file is part of the PSR Cache proposal with multiple cache interfaces.
 * Included in the smCore Cache component for information
 *  and eventual test implementations.
 * https://github.com/tedivm/fig-standards
 * @author tedivm
 */

namespace smCore\cache\psr\extensions;
use smCore\cache\psr\Item;

/**
 * TaggableItem extends Item to provide tagging support.
 *
 * The TaggableItem interface adds support for tagging to the
 * base cache Item interface. Items can be added to multiple categories (called
 * tags) that can be used for group invalidation.
 */

interface TaggableItem extends Item
{
    /**
     * Sets the tags for the current item.
     *
     * Accepts an array of strings for the item to be tagged with. The tags
     * passed should overwrite any existing tags, and passing an empty array
     * will cause all tags to be removed. Changes to an Item's tags are not
     * guaranteed to persist unless the "set" function is called.
     *
     * @param array $tags
     * @return void
     */
    function setTags(array $tags = array());
}
