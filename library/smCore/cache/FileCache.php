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

namespace smCore\cache;
use smCore\logging\Debug;

/**
 * Filesystem cache class.
 * This is a simple file caching mechanism, same as done by SMF previously.
 *
 */
class FileCache implements CacheProvider
{
	private $_directory;

	public function __construct($options)
	{
		// innocence :P
		$this->_directory = $options['cachedir'];
		if (!is_dir($this->_directory) || !is_writable($this->_directory))
			throw new Exception('Unable to write to cache dir: ' . $this->directory);
	}

	/**
	 * Retrieve a cached entry.
	 * @see smCore\cache.CacheProvider::get()
	 */
	public function get($key)
	{
		// Do this old style, improve later.

		@include($this->_directory . '/data_' . $key . '.php');
		// Debug::log(!empty($expired) ? '$expired=' . $expired : ' $expired=not_expired.');
		if (!empty($expired) && isset($value))
		{
			@unlink($this->_directory . '/data_' . $key . '.php');
			unset($value);
		}
		else
		{
			// Debug::log('time() = ' . time());
		}
		return (isset($value) ? $value : false);
	}

	/**
	 * Invalidate all cache.
	 * @see smCore\cache.CacheProvider::invalidate()
	 */
	public function invalidate()
	{
		// might want to remove physically all cache
		// only during low online times (by a scheduled task)
		$files = glob($this->_directory.'/*');
		foreach ($files as $file)
		{
			if ($file != 'index.php')
				@unlink($file);
		}
	}

	/**
	 * Invalidate a key.
	 * @see smCore\cache.CacheProvider::invalidateKey()
	 */
	public function invalidateKey($key)
	{
		@unlink($this->_directory . '/data_' . $key . '.php');
	}

	/**
	 * Cache an entry.
	 * @see smCore\cache.CacheProvider::put()
	 */
	public function set($key, $data, $ttl = 120)
	{
		// Do this good ole' style.
		if ($data === null)
		{
			$this->invalidateKey($key);
		}
		else
		{
			// Debug::log('Will add expire time: ' . (time() + $ttl) . ' for $ttl=' . $ttl);
			$cacheData = '<' . '?' . 'php if (!defined(\'SMCORE\')) die; if (' . (time() + $ttl) . ' < time()) $expired = true; else{$expired = false; $value = \'' . addcslashes($data, '\\\'') . '\';}' . '?' . '>';

			// Write out the cache file, check that the cache write was successful; all the data must be written
			// If it fails due to low diskspace, or other, remove the cache file
			if (file_put_contents($this->_directory . '/data_' . $key . '.php', $cacheData, LOCK_EX) !== strlen($cacheData))
				@unlink($this->_directory . '/data_' . $key . '.php');
		}
	}
}