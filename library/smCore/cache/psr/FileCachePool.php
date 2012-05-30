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
 * Simple cache pool for a filesystem-based cache.
 * Implementation of the PSR-Cache proposal.
 * https://github.com/tedivm/fig-standards
 * @author norv@simplemachines.org
 */

class FileCachePool implements Pool
{
	private $_directory;
	/**
	 * @var \ArrayObject
	 */
	private $_items;

	public function __construct(array $options)
	{
		$this->_directory = $options['cachedir'];
		if (!is_dir($this->_directory) || !is_writable($this->_directory))
			throw new Exception('Unable to write to cache dir: ' . $this->directory);
		$this->_items = new \ArrayObject();
	}

	/**
 	 * @see smCore\cache.Pool::getCache()
	 */
	function getCache($key)
	{
		if (array_key_exists($key, $this->_items))
			return $this->_items[$key];

		// Do this old style, and no checks.
		@include($this->_directory . '/data_' . $key . '.php');
		// Debug::log(!empty($expired) ? '$expired=' . $expired : ' $expired=not_expired.');
		if (!empty($expired) && isset($value))
		{
			@unlink($this->_directory . '/data_' . $key . '.php');
			unset($value);
		}
		$item = new FileCacheItem($key, isset($value) ? $value : null, !isset($value) ? true : false);
		$item->setPool($this);
		$this->_items[$key] = $item;
		return $item;
	}

	/**
	 * @see smCore\cache.Pool::getCacheIterator()
	 */
	function getCacheIterator($keys)
	{
		// intensive implementation
		foreach ($keys as $key)
		{
			$this->getCache($key);
		}

		// so return an iterator for our array.
		return new \ArrayIterator(array_intersect_key($this->_items->getArrayCopy(), array_flip($keys)));
	}

	/**
	 * @see smCore\cache.Pool::flush()
	 */
	function flush()
	{
		$files = glob($this->_directory.'/*');
		foreach ($files as $file)
			@unlink($file);
		$this->_items = new \ArrayObject();
	}

	/**
	 * Removes the cached data for the given $key.
	 *
	 * @param string $key
	 */
	public function removeItem($key)
	{
		// innocently assume :P
		@unlink($this->_directory . '/data_' . $key . '.php');

		// remove it from the known keys
		$this->_items->offsetUnset($key);

		return true;
	}

	/**
	 * Caches the data passed to it.
	 *
	 * @param Item $item
	 * @param mixed $value
	 * @param int|DateInterval|null $ttl
	 */
	public function setCache($item, $value, $ttl = null)
	{
		// KISS
		$cacheData = '<' . '?' . 'php if (!defined(\'SMCORE\')) die; if (' . (time() + $ttl) . ' < time()) $expired = true; else{$expired = false; $value = \'' . addcslashes($value, '\\\'') . '\';}' . '?' . '>';

		// Try to write
		if (file_put_contents($this->_directory . '/data_' . $item->getKey() . '.php', $cacheData, LOCK_EX) !== strlen($cacheData))
		{
			@unlink($this->_directory . '/data_' . $item->getKey() . '.php');

			assert($this->_items->offsetExists($key));
			// then remove it altogether
			unset($this->_items[$key]);
			return false;
		}
		$this->_items[$item->getKey()] = $item;
		return true;
	}

}