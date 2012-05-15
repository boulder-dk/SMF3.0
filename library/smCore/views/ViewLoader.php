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

namespace smCore\views;

/**
 * Class ViewLoader.
 * Keeps track of view types and engines, and is used to load and give control to the appropriate
 * output engine.
 *
 * @author Norv <norv@simplemachines.org>
 */
class ViewLoader
{
	private static $_wireless = false;
	private static $_rss = false;
	private static $_ajax = false;

	private static $_engineName = 'Twig';
	private static $_engineRegistry = array();
	private static $_engine = null;

	public static function initialize()
	{
		self::$_engineRegistry = array(
			 'smTE',
			 'Twig',
			 'PHP'
		);
		self::$_engineName = 'Twig';
	}

	public static function is_wireless()
	{
		return self::$_wireless;
	}

	public static function is_rss()
	{
		return self::$_rss;
	}

	public static function is_ajax()
	{
		return self::$_ajax;
	}

	/**
	 * Retrieve the current engine.
	 *
	 * @return string
	 */
	public static function get_engine_name()
	{
		return self::$_engineName;
	}

	/**
	 * Change the current engine to $engine.
	 * Register it, if necessary.
	 *
	 * @param string $engine
	 */
	public static function set_engine($engine)
	{
		if (!is_array(self::$_engineRegistry))
			self::$_engineRegistry = array($engine);
		if (!in_array($engine, self::$_engineRegistry))
			self::$_engineRegistry[] = $engine;
		self::$_engineName = $engine;
	}

	/**
	 * Retrieve the current engine, if it has been loaded.
	 *
	 * @return Engine
	 * @throws LogicException if the engine hasn't been loaded.
	 */
	public static function get_engine()
	{
		if (empty(self::$_engine))
			throw new LogicException('invalid_state');
		return self::$_engine;
	}

	/**
	 * Load the templating engine, and initialize it.
	 *
	 * @param string $themeName
	 * @param string $themeDir
	 */
	public static function load_engine($themeName, $themeDir)
	{
		// Lets do it through the EngineInterface, but use a switch for the moment.
		switch (self::$_engineName)
		{
			case 'Twig':
				self::$_engine = new TwigEngine();
				self::$_engine->initialize($themeName, $themeDir);

				break;
			case 'smTE':
				self::$_engine = new SmteEngine();
				self::$_engine->initialize($themeName, $themeDir);

				break;
			case 'PHP':


				break;

			default:
				break;
		}
	}
}
