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

interface CacheProvider
{
	/**
	 * Retrieve a value from the cache, for the corresponding key.
	 *
	 * The key must uniquely identify the cached data.
	 * The CacheProvider may store in any way (including encoding).
	 *
	 * @param string $key
	 */
	function get($key);

	/**
	 * Adds (or replaces) a new value to the cache.
	 * The defined behavior requires the data to be either retrievable
	 * as it was sent, for the respective $key, either null.
	 *
	 * $ttl parameter, if specified, is given in seconds or DateInterval,
	 * and the underlying implementation must expire the data at last after
	 * the time passes.
	 * (if supported)
	 *
	 * @param string $key
	 * @param mixed|null $data
	 * @param int|DateInterval|null $ttl
	 */
	function set($key, $data, $ttl = 120);

	/**
	 * Invalidates the entire cache.
	 * The implementing CacheProvider should no longer return
	 * the invalidated data, forcing recalculation from the client code.
	 */
	function invalidate();

	/**
	 * Invalidates the cached data for the key $key.
	 * The implementing CacheProvider should no longer return
	 * the invalidated data, forcing recalculation from the client code.
	 *
	 * @param string $key
	 */
	function invalidateKey($key);
}