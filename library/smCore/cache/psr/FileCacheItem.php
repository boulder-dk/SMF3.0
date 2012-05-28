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
use smCore\cache\psr\CacheItem, smCore\cache\psr\CachePool;

class FileCacheItem extends CacheItem
{
	/**
	 * This item's pool
	 * @var smCore\cache\psr\Pool
	 */
	private $_pool;

	public function __construct($key, $value = null, $miss = false)
	{
		parent::__construct($key, $value, $miss);
	}

	/**
	 * @see smCore\cache\psr.Item::set()
	 */
	public function set($value, $ttl = null)
	{
		if ($this->_pool->setCache($this, $value, $ttl))
		{
			// Successful
			$this->_value = $value;
			$this->_miss = false;
			return true;
		}
		else
		{
			// Not successful, invalidate the item.
			$this->_value = null;
			$this->_miss = true;
			return false;
		}
	}

	/**
	 * @see smCore\cache\psr.Item::remove()
	 */
	public function remove()
	{
		// remove() should remove the key from the cache
		// leaving us with a miss (and null value)
		// does this really belong on the Item?
		if ($this->_pool->removeItem($this->_key))
		{
			$this->_value = null;
			$this->_miss = true;
			return true;
		}
		return false;
	}

	public function setPool(Pool $pool)
	{
		$this->_pool = $pool;
	}
}