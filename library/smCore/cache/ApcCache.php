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
	/**
	 * Retrieve a cached entry.
	 * @see smCore\cache.CacheProvider::get()
	 */
	public function get($key, $ttl = 120)
	{
		// Simply use what we have here, it's good stuff.
		if (function_exists('apc_fetch'))
			return apc_fetch($key . 'smc');
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
		if (function_exists('apc_delete'))
			apc_delete($key . 'smc');
	}

	/**
	 * Cache an entry.
	 * @see smCore\cache.CacheProvider::put()
	 */
	public function put($key, $data, $ttl = 120)
	{
		// we're going to regret these function_exists, I can tell :P
		if (function_exists('apc_store'))
		{
			if ($value === null)
				apc_delete($key . 'smc');
			else
				apc_store($key . 'smc', $data, $ttl);
		}
	}
}