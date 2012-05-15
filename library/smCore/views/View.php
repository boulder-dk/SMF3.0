<?php

/**
 * smCore platform
 *
 * @package smCore
 * @author Norv
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
use smCore\model\User, smCore\TemplateEngine\Expression, smCore\Language, smCore\storage\Storage,
	\Settings, smCore\Application, smCore\Exception, smCore\views\ViewLoader;

/**
 * View manager. More of a theme manager for the moment.
 */
class View
{
	/**
	 * @var View
	 */
	private static $_instance = null;

	/**
	 * @var array
	 */
	private $_headers = null;
	/**
	 * html after template
	 * @var array
	 */
	private $_insert_after_template = '';

	/**
	 * Make an instance too, if you will.
	 */
	private function __construct()
	{
		//
	}

	/**
	 * Setup the theme. This is the initialization of the theme for the application.
	 */
	public function setupTheme()
	{
		$user = User::currentUser();
		$id = $user->getThemeId();

		Application::addToContext(array(
			'page_title' => '...',
			'reload_counter' => 0,
			// 'theme_url',
			// 'default_theme_url',
			'scripturl' => Settings::APP_URL,
			'time_display' => date('g:i:s A', time()),
			'route' => array(null, null, null),
			)
		);

		ViewLoader::get_engine()->setupTheme();
	}

	/**
	 * Load data for theme with the given theme ID.
	 * This method will initialize the templating engine, for the given theme.
	 *
	 * @param int $id
	 * @throws \smCore\Exception
	 */
	public function loadThemeData($id)
	{
		$themeData = Storage::getThemeStorage()->loadThemeData($id);

		// If the user's theme doesn't exist, try the default theme instead
		if (empty($themeData) && $id != 1)
			$themeData = Storage::getThemeStorage()->loadThemeData(1);

		if (empty($themeData))
			throw new Exception('no_default_theme');

		ViewLoader::load_engine($themeData['theme_name'], $themeData['theme_dir']);

	}

	/**
	 * Retrieve the instance if needed.
	 * It probably won't be too often.
	 *
	 * @static
	 * @param bool $setupTheme=true
	 * @return \smCore\views\View
	 */
	public static function initialize($setupTheme = true)
	{
		if (self::$_instance === null)
			self::$_instance = new self();
		if ($setupTheme === true)
			self::$_instance->setupTheme();
		return self::$_instance;
	}
}

/**
 * Temporary function, to send off control to the templating engine.
 */
function display()
{
	// Set the rest necessary.
	// Complete the $context array, for the engine to read.

	$context = Application::getInstance()->context();

	// Allow modules to hook into it.
	Event::fireEvent($this, 'beforeDisplay', $context);

	// Same for the ViewSettings.

	// And go.
	ViewLoader::get_engine()->display();
}