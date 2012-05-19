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
 * Null cache class.
 *
 */
class NullCache implements CacheProvider
{
	/**
	 * NullCache will not return anything.
	 *
	 * @see smCore\cache.CacheProvider::get()
	 */
	public function get($key, $ttl = 120)
	{
		// Nothing to see here...
		return false;
	}

	/**
	 * Default empty implementation.
	 *
	 * @see smCore\cache.CacheProvider::invalidate()
	 */
	public function invalidate()
	{
		// We're as invalid as it gets :P
	}

	/**
	 * Default empty implementation.
	 *
	 * @see smCore\cache.CacheProvider::invalidateKey()
	 */
	public function invalidateKey($key)
	{
		// Already done.
	}

	/**
	 * Default empty implementation.
	 *
	 * @see smCore\cache.CacheProvider::put()
	 */
	public function put($key, $data, $ttl = 120)
	{
		// Sorry, we don't put data anywhere.
	}
}