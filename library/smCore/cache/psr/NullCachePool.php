<?php

/**
 * smCore platform
 *
 * @package smCore
 * @license MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version 1.1
 * (the "License"); you may not use this package except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * The Original Code is smCore.
 *
 * The Initial Developer of the Original Code is the smCore project.
 *
 * Portions created by the Initial Developer are Copyright (C) 2012
 * the Initial Developer. All Rights Reserved.
 *
 * Contributor(s):
 */

namespace smCore\cache\psr;

/**
 * Implementation of the PSR-Cache proposal.
 * https://github.com/tedivm/fig-standards
 * @author norv@simplemachines.org
 */
class NullCachePool implements Pool
{
	/**
	 * @var Item
	 */
	private $_item;

	public function __construct(array $settings)
	{
		$this->_item = new NullCacheItem();
	}

	/**
	 * @see smCore\cache\psr.Pool::getCache()
	 */
	public function getCache($key)
	{
		return $this->_item;
	}

	/**
	 * @see smCore\cache\psr.Pool::getCacheIterator()
	 */
	public function getCacheIterator($keys)
	{
		return new \ArrayIterator(array());
	}

	/**
	 * @see smCore\cache\psr.Pool::flush()
	 */
	public function flush()
	{
		// emptied it is.
	}
}
