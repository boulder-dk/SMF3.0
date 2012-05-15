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
use smCore\model\Module;

/**
 * Class SmteEngine.
 *
 */
class SmteEngine implements Engine
{
	private $_theme = null;
	private $_cssFiles = array();
	private $_jsFiles = array();

	public function initialize($themeName, $themeDir)
	{
		// register autoloader, if case may be
		// or add directory/ies to standard autoloader paths.

		// initialize
		include_once(Settings::APP_THEME_DIR . '/' . $themeDir . '/include.php');
		$theme = new Theme($themeName, $themeDir);
		// $theme = new $themeData['theme_class']($themeData['theme_name']);
	}

	public function display()
	{

	}

	public function setupTheme()
	{
		$this->_theme = $this->loadThemeData($id);

		// lets suppose the old initialization is in place here.
		$this->_theme->loadTemplates('index');
		$this->_theme->addLayer('main', 'site');

		$this->_theme->addNamespace('ui', 'me.smcore.ui');

		$this->_theme->loadTemplates('common');


		Expression::setLangFunction('smCore\Language::getLanguage()->get');
		// Expression::setFormatFunction('smCore\views\ToxgFormat::format');

	}

	/**
	 * Retrieve the current theme
	 *
	 * @return \smCore\TemplateEngine\Theme
	 */
	public function getTheme()
	{
		return $this->_theme;
	}

	public function moduleInit($module)
	{
		$this->_theme->addNamespace($module->config('template_ns'), $module->config('identifier'));
	}

	public function loadTemplate($name, $directory)
	{
		$this->_theme->loadTemplates($directory . '/' . $name . '.tox');
	}

	public function addTemplate($name, $namespace = null)
	{
		$this->_theme->addTemplate($name, $namespace);
	}

	public function load_css_file($filename, $options = array())
	{
		$this->_cssFiles[$filename] = $options;
	}

	public function load_js_file($filename, $options = array())
	{
		$this->_jsFiles[$filename] = $options;
	}
}

