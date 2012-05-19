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
 * @version 1.0 alpha
 *
 */

namespace smCore\handlers;

use smCore\Config;

/**
 * DefaultErrorHandler of the platform.
 * Defines the static method errorHandler() to replace PHP default handler.
 */
class DefaultErrorHandler
{
	/**
	 * Set as error handler callback by default.
	 *
	 * @static
	 * @param $errno
	 * @param $errstr
	 * @param $errfile
	 * @param $errline
	 */
	public static function errorHandler($errno, $errstr, $errfile, $errline)
	{
		if ((error_reporting() == 0 || (defined('E_STRICT') && $errno == E_STRICT)))
		{
			// Remember this is not included in error_reporting
			return;
		}
		
		// log the error.

		// in debug mode, show it off!
		if (isset($db_show_debug) && $db_show_debug === true)
		{
			// Debug silly message.
			
			// Log extra info
		}

		echo ('Error: ' . $errstr . ' in ' . $errfile . ' on line ' . $errline . '<br />' . PHP_EOL);
		echo debug_backtrace();
		
		// Forgive some more?
		
		// Things die.  @todo uncomment.
		// die();
	}
}