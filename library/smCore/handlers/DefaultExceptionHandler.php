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
use smCore\Application, smCore\storage\Storage, smCore\views\View, smCore\Language,
	ToxgException, smCore\FatalException;

/**
 * DefaultExceptionHandler of the platform.
 * Defines the static method exceptionHandler() to replace PHP default handler.
 */
class DefaultExceptionHandler
{
	/**
	 * Set as exception handler callback by default.
	 *
	 * @static
	 * @param $exception
	 */
	public static function exceptionHandler($exception)
	{
		// Make sure that for fatal exception we exit immediately... this time.
		if ($exception instanceof FatalException)
		{
			if ($exception->getArea() === 'database')
			{
				// Try to set up information... maybe somebody will read it later :P
				Application::addValueToContext('error_title', Language::getLanguage()->get('database_error'));
				Application::addValueToContext('error_message', $exception->getMessage());
			}

			die ($exception->getMessage());
		}

		// If possible (view system is loaded)
		// try to show the error subtemplate and messages.
		
		echo 'Uncaught exception error:<hr />' . $exception->getMessage() . '</ br>' . PHP_EOL;

		// Remember to check exception area, and then, code

		// Be certain.  @todo uncomment.
		// die();
	}
}