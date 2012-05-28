<?php

namespace smCore\cache\psr;
use smCore\logging\Debug;

use smCore\cache\psr\Pool, smCore\cache\psr\FileCacheItem;

/**
 * Cache pool.
 * In-memory simple implementation of the PSR-Cache proposal.
 * @author norv
 */

class MemoryCachePool implements Pool
{
	/**
	 * @var \ArrayObject
	 */
	private $_items;

	public function __construct(array $options = null)
	{
		$this->_items = new \ArrayObject();
	}

	/**
 	 * @see smCore\cache.Pool::getCache()
	 */
	function getCache($key)
	{
		if (array_key_exists($key, $this->_items))
			return $this->_items[$key];
		$item = new MemoryCacheItem($key, isset($value) ? $value : null, !isset($value) ? true : false);
		$item->setPool($this);
		$this->_items[$key] = $item;
		return $item;
	}

	/**
	 * @see smCore\cache.Pool::getCacheIterator()
	 */
	function getCacheIterator($keys)
	{
		return new \ArrayIterator(array_intersect_key($this->_items->getArrayCopy(), array_flip($keys)));
	}

	/**
	 * @see smCore\cache.Pool::flush()
	 */
	function flush()
	{
		$this->_items = new \ArrayObject();
	}

	public function removeItem($key)
	{
		// remove it from the known keys
		$this->_items->offsetUnset($key);
	}

	public function setCache($item, $value, $ttl = null)
	{
		// We don't know TTL
		$this->_items[$item->getKey()] = $item;
		return true;
	}

}