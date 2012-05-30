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

		$type = ucfirst(Settings::$cacheOptions['type']);
		if (empty($type) || !class_exists('smCore\cache\\' . $type . 'Cache', true))
		{
			// no cache for us.
			self::$_instance = new NullCache();
		}
		else
		{
			// know what you want? Good.
			try
			{
				$type = 'smCore\cache\\' . $type . 'Cache';
				self::$_instance = new $type(Settings::$cacheOptions);
			}
			catch (Exception $e)
			{
				Debug::write($e);
			}
		}
		if (!empty(self::$_instance))
			return self::$_instance;
		// fallback
	}

	private function __construct(){}
}