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
 * StackableItem extends the Cache system Item interface to provide stacking support.
 *
 * The StackableItem interface adds support for stacking to the
 * base Item interface. When a StackableItem is cleared it also clears the
 * items nested beneath it.
 */
interface StackableItem extends Item
{

}
