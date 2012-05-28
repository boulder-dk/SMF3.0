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

/**
 * APC cache class.
 *
 */
class ApcCache implements CacheProvider
{
	public function __construct($settings)
	{
		// $settings for anything needed on initialization
	}

	/**
	 * Retrieve a cached entry.
	 * @see smCore\cache.CacheProvider::get()
	 */
	public function get($key)
	{
		// try eaccelerator
		if (function_exists('eaccelerator_get'))
			return eaccelerator_get($key);
		return false;
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
		if (function_exists('eaccelerator_rm'))
			eaccelerator_rm($key);
	}

	/**
	 * Cache an entry.
	 * @see smCore\cache.CacheProvider::put()
	 */
	public function set($key, $data, $ttl = 120)
	{
		if (function_exists('eaccelerator_put'))
		{
			// Give it a hand :P
			if (mt_rand(0, 10) == 1)
				eaccelerator_gc();

			if ($data === null)
				eaccelerator_rm($key);
			else
				eaccelerator_put($key, $data, $ttl);
		}
	}
}