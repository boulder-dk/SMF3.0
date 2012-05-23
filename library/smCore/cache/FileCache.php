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
use \Settings;

/**
 * Filesystem cache class.
 * This is a simple file caching mechanism, same as done by SMF previously.
 *
 */
class FileCache implements CacheProvider
{
	/**
	 * Retrieve a cached entry.
	 * @see smCore\cache.CacheProvider::get()
	 */
	public function get($key, $ttl = 120)
	{
		// Do this old style, improve later.
		if (file_exists(Settings::APP_CACHE_DIR . '/data_' . $key . '.php') && filesize(Settings::APP_CACHE_DIR . '/data_' . $key . '.php') > 10)
		{
			@include(Settings::APP_CACHE_DIR . '/data_' . $key . '.php');
			if (!empty($expired) && isset($value))
			{
				@unlink(Settings::APP_CACHE_DIR . '/data_' . $key . '.php');
				unset($value);
			}
		}
		return (isset($value) ? $value : false);
	}

	/**
	 * Invalidate all cache.
	 * @see smCore\cache.CacheProvider::invalidate()
	 */
	public function invalidate()
	{
		// @todo
		// might want to remove physically all cache
		// only during low online times (by a scheduled task)
		// until then, invalidate the keys
	}

	/**
	 * Invalidate a key.
	 * @see smCore\cache.CacheProvider::invalidateKey()
	 */
	public function invalidateKey($key)
	{
		@unlink(Settings::APP_CACHE_DIR . '/data_' . $key . '.php');
	}

	/**
	 * Cache an entry.
	 * @see smCore\cache.CacheProvider::put()
	 */
	public function put($key, $data, $ttl = 120)
	{
		// Do this good ole' style.
		if ($data === null)
		{
			$this->invalidateKey($key);
		}
		else
		{
			$cacheData = '<' . '?' . 'php if (!defined(\'SMCORE\')) die; if (' . (time() + $ttl) . ' < time()) $expired = true; else{$expired = false; $value = \'' . addcslashes($data, '\\\'') . '\';}' . '?' . '>';

			// Write out the cache file, check that the cache write was successful; all the data must be written
			// If it fails due to low diskspace, or other, remove the cache file
			if (file_put_contents(Settings::APP_CACHE_DIR . '/data_' . $key . '.php', $cacheData, LOCK_EX) !== strlen($cacheData))
				@unlink(Settings::APP_CACHE_DIR . '/data_' . $key . '.php');
		}
	}
}