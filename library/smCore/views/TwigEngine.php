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

/**
 * Class TwigEngine
 *
 */
class TwigEngine implements Engine
{
	private $_environment = null;
	private $_cssFiles = array();
	private $_jsFiles = array();

	public function initialize($themeName, $themeDir)
	{
		// Register autoloader
		require_once (dirname(dirname(__DIR__)) . '/twig/lib/Twig/Autoloader.php');
		Twig_Autoloader::register();

		// load environment
		$loader = new Twig_Loader_Filesystem(Settings::APP_THEME_DIR . '/' . $themeDir);
		$this->_environment = new Twig_Environment($loader, array(
			'cache' => Settings::APP_THEME_DIR . '/' . $themeDir,
		));

		// be sure
		$this->_jsFiles = array();
	}

	public function setupTheme()
	{
		// @todo
	}

	public function display()
	{
		// @todo
		echo $this->_environment->render('index.html.twig', array(
			 'context' => Application::context()));
	}

	public function moduleInit($module)
	{
		// anything to do
	}

	public function loadTemplate($name, $module = null) {

	}

	public function addTemplate($name, $namespace = null) {

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
