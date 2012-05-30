<?php

/**
 * smCore platform
 *
 * @package database
 * @license MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version 1.1
 * (the "License"); you may not use this package except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * The Original Code is smCore.
 *
 * The Initial Developer of the Original Code is Simple Machines and contributors.
 *
 * Portions created by the Initial Developer are Copyright (C) 2012
 * the Initial Developer. All Rights Reserved.
 *
 * @version 1.0 alpha
 *
 */

namespace database;

/**
 * This class' job is to retrieve the adapter for the specific database system.
 */
class DatabaseFactory
{
	private static $_adapter;

	/**
	 * Create or get an adapter of the specific type for our database system.
	 *
	 * @param $adapter
	 * @param string $type - default options: 'default', 'extra', 'packages'.
	 * @internal param string $db_type - default options: 'mysql', 'postgresql', 'sqlite'
	 * (more can be aded)
	 * @return \database\DatabaseAdapter
	 */
	public static function getAdapter($adapter, $type = 'default')
	{
		assert (!empty($adapter));
		$adapter = strtolower($adapter);
		assert (in_array($adapter, array('mysql', 'postgresql', 'sqlite')));

		if (empty(self::$_adapter))
		{
			$adapterName = 'database\\' . ucfirst($type) . ucfirst($adapter) . 'Adapter';
			// if (file_exists($adapterName . '.php'))
			//	require_once($adapterName . '.php');

			self::$_adapter = new $adapterName();
		}
		return self::$_adapter;
	}
}