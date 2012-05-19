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
 * Cache sub-system.
 */
class Cache
{
	/**
	 * The cache system in use.
	 *
	 * @var CacheProvider
	 */
	private static $_instance = null;

	/**
	 * Retrieve the actual system cache.
	 * Still keep things very simple.
	 *
	 * @param string $type
	 */
	public static function instance()
	{
		if (!empty(self::$_instance))
			return self::$_instance;

		$type = ucfirst(Settings::APP_CACHE_TYPE);
		if (empty($type) || !class_exists('smCore\cache\\' . $type . 'Cache', true))
		{
			// no cache for us.
			self::$_instance = new NullCache();
		}
		else
		{
			// know what you want? Good.
			$type = 'smCore\cache\\' . $type . 'Cache';
			self::$_instance = new $type;
		}
		return self::$_instance;
	}

	/*
	* Do something unorthodox here.
 	* Just drop some static methods delegate to the actual system cache operations.
 	* (to be refactored)
 	*/
	public static function get($key, $ttl = 120)
	{
		return self::instance()->get($key, $ttl);
	}

	public static function invalidate()
	{
		self::instance()->invalidate();
	}

	public static function invalidateKey($key)
	{
		self::instance()->invalidateKey($key);
	}

	public static function put($key, $data, $ttl = 120)
	{
		self::instance()->put($key, $data, $ttl);
	}
}