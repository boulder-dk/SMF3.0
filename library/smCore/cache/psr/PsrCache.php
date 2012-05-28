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
use \Settings;

/**
 * Cache sub-system.
 * This class works with an implementation of PSR proposal for Cache API
 * https://github.com/tedivm/fig-standards
 */
class PsrCache
{
	/**
	 * The cache system in use.
	 *
	 * @var Pool
	 */
	private static $_instance = null;

	/**
	 * Retrieve the actual system cache.
	 * Still keep things very simple.
	 */
	public static function instance()
	{
		if (!empty(self::$_instance))
			return self::$_instance;

		$type = ucfirst(Settings::$cacheOptions['type']);
		if (empty($type) || !class_exists('smCore\cache\psr\\' . $type . 'CachePool', true))
		{
			// no cache for us.
			self::$_instance = new NullCachePool();
		}
		else
		{
			// know what you want? Good.
			try
			{
				$type = 'smCore\cache\psr\\' . $type . 'CachePool';
				self::$_instance = new $type(Settings::$cacheOptions);
			}
			catch (Exception $e)
			{
				// check this
				Debug::write($e);
			}
		}
		if (!empty(self::$_instance))
			return self::$_instance;
		// fallback
	}
}