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
 * Engine represents the interface to a templating engine.
 *
 */
interface Engine
{
	/**
	 * Initialize the engine.
	 *
	 * @param string $themeName
	 * @param string $themeDir
	 */
	public function initialize($themeName, $themeDir);

	/**
	 * Give control to the engine, to display.
	 */
	public function display();

	/**
	 * Set up the theme.
	 */
	public function setupTheme();

	/**
	 * Initialize for module use
	 */
	public function moduleInit($module);

	/**
	 * @param string $templateName
	 * @param Module $module
	 */
	public function loadTemplate($name, $module = null);

	/**
	 * @param string $name
	 * @param string $namespace = null
	 */
	public function addTemplate($name, $namespace = null);

	/**
	* Add a CSS file for output later
	*
	* @param string $filename
	* @param array $options
	*/
	public function load_css_file($filename, $options = array());

	/**
	* Add a js file for output later
	*
	* @param string $filename
	* @param array $options
	*/
	public function load_js_file($filename, $options = array());

}
