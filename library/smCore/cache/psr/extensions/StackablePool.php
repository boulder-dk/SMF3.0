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
 * Cache\Extensions\StackablePool extends Cache\Pool to provide stacking support.
 *
 * The Cache\Extensions\StackablePool interface adds support for returning
 * Cache\Extensions\StackableItem objects. This works primarily by defining the
 * Key to use a slash as a delimiter, similar to a filesystem, to nest keys.
 * When a StackableItem is cleared it also clears the items nested beneath it.
 */
interface StackablePool extends Pool
{

}