<?php

/**
 * smCore platform
 *
 * @package smCore
 * @author Fustrate
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

namespace smCore;

use smCore\Request, smCore\Url, smCore\ModuleRegistry, smCore\DefaultAutoloader, smCore\Language,
	 smCore\model\User, smCore\AccessManager, smCore\Router, smCore\events\EventDispatcher,
	 smCore\storage\Storage, smCore\security\Session, smCore\views\View, smCore\views\ViewLoader,
	 smCore\BrowserDetector, \Settings;

/**
 * This is the bootstrap class of the platform.
 * It takes care of loading the absolutely needed, and then it delegates control to
 * the specific action handler. The action handler is a controller from a module.
 *
 */
class Application {

	/**
	 * Singleton pattern instance
	 */
	private static $_instance = null;

	/**
	 * The application boots only once.
	 * @var bool=false
	 */
	private static $_hasBooted = false;
	// remove the registry.
	private static $_registry = array();
	private static $_cache = null;
	private $_request = null;
	private $_response = null;
	public $_dispatcher = null;
	public $_context = array();
	public $_time = 0;
	private static $_start_time = 0;

	private function __clone()
	{

	}

	/**
	 * @static
	 * @return \smCore\Application
	 */
	public static function getInstance()
	{
		if (self::$_instance === null)
			self::$_instance = new self();

		return self::$_instance;
	}

	/**
	 * Create this instance.
	 */
	protected function __construct()
	{
		require_once(dirname(dirname(dirname(__FILE__))) . '/Settings.php');
	}

	/**
	 * Load all the needed and put things in motion.
	 */
	public final function boot()
	{
		// check if we've been called before. Shouldn't happen.
		if (self::$_hasBooted)
			return;

		self::$_start_time = microtime(true);
		date_default_timezone_set(Settings::APP_TIMEZONE);
		$this->_time = time();

		// @todo this is off for debugging purposes
		// ob_start()

		self::$_hasBooted = true;

		// Register things... autoloader
		require_once(__DIR__ . '/DefaultAutoloader.php');
		DefaultAutoloader::register();

		// Error handler...
		set_error_handler(array('\\smCore\\handlers\\DefaultErrorHandler', 'errorHandler'));
		error_reporting(E_ALL | E_STRICT);

		// Exception handler
		set_exception_handler(array('\\smCore\\handlers\\DefaultExceptionHandler', 'exceptionHandler'));

		// Starting up...
		// ob_start();
		// Initialize database connection
		Storage::initConnection(Settings::$database);

		// No access to database details after this point
		Settings::$database = null;

		// Start session!
		Session::startSession();

		// Initialize modules registry
		ModuleRegistry::recompile();

		// Load language...
		Language::getDefaultLanguage();
		$user = User::currentUser();
		if ($user->get('language') !== 'english_us')
			Language::getUserLanguage($user->get('language'));

		// Setup view environment...
		View::initialize();

		// Initialize menu...
		// Lets accept this for now.
		Menu::setupMenu($this->_context, Router::getInstance()->getRoutes(), true);
		Language::getLanguage()->load(\Settings::APP_LANGUAGE_DIR . '/menu.yaml');

		// Find the route and dispatch
		Router::dispatch();

		// this is a beauty.
		ViewLoader::get_engine()->display();
	}

	/**
	 * Loads information about what browser the user is viewing with and places it in $context
	 *
	 */
	public function detectBrowser()
	{
		// Load the current user's browser of choice
		$detector = new BrowserDetector();
		$detector->detectBrowser();
	}

	/**
	 * Are we using this browser?
	 *
	 * Wrapper function for detectBrowser
	 * @param $browser: browser we are checking for.
	 */
	public function isBrowser($browser)
	{
		// Don't know any browser!
		if (empty(self::getInstance()->_context['browser']))
			$this->detectBrowser();

		return !empty(self::getInstance()->_context['browser'][$browser]) || !empty(self::getInstance()->_context['browser']['is_' . $browser]) ? true : false;
	}

	/**
	 * Add to context array an additional array.
	 *
	 * @param $toAdd
	 */
	public static function addToContext($toAdd)
	{
		// @todo check toAdd and merge it as appropriate.
		self::getInstance()->_context += $toAdd;
	}

	/**
	 * Stuff. Add to context array.
	 * Convenience method for adding a (key, value) pair to the $context array
	 * to be sent to the template.
	 * This should probably move from Application class.
	 *
	 * @param string $key
	 * @param string $value
	 */
	public static function addValueToContext($key, $value)
	{
		self::getInstance()->_context[$key] = $value;
	}

	/**
	 * Stuff. Redundant method for the moment, to reset values in contextual array.
	 *
	 * @param string $key
	 * @param string $value
	 */
	public static function setValueToContext($key, $value)
	{
		self::getInstance()->_context[$key] = $value;
	}

	/**
	 * Contextual array...
	 *
	 * @return array
	 */
	public function context()
	{
		return $this->_context;
	}

	/**
	 * Get start time
	 *
	 * @return int
	 */
	static function getStartTime()
	{
		return self::$_start_time;
	}

	/**
	 * Use a registry for some needed values
	 *
	 * @static
	 * @param $key
	 * @param $value
	 */
	static function set($key, $value)
	{
		if ($value === null)
			unset(self::$_registry[$key]);
		else
			self::$_registry[$key] = $value;
	}

	/**
	 * Retrieve from registry
	 *
	 * @static
	 * @param $key
	 * @return mixed
	 */
	static function get($key)
	{
		if (array_key_exists($key, self::$_registry))
		{
			return self::$_registry[$key];
		}
		else
		{
			return '';
		}
	}

}