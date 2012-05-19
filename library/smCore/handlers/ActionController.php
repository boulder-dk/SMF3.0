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
 */

namespace smCore\handlers;
use smCore\model\Module, smCore\views\ViewLoader,
	smCore\security\Action, smCore\logging\Debug;

/**
 * Abstract class ActionController
 * Provides interface and useful default methods for action handlers (ActionControllers)
 */
abstract class ActionController
{
	/**
	 * Parent module of this action controller.
	 * @var Module
	 */
	protected $_parentModule;
	
	/**
	 * The context stacks the data to pass to the template(s).
	 * @var array
	 */
	protected $_context;
	
	/**
	 * The action currently executed.
	 * @var Action
	 */
	protected $_action;

	/**
	 * Constructor takes the parent Module as parameter.
	 *
	 * @param \smCore\model\Module $parentModule
	 */
	public function __construct($action, Module $parentModule = null)
	{
		$this->_action = $action;
		$this->_parentModule = $parentModule;
		$this->_context = array();
	}

	/**
	 * Load templates. Should find them in their directory.
	 *
	 * @param string $name
	 */
	function loadTemplates($name)
	{
		try 
		{
			ViewLoader::engine()->loadTemplate($name, $this->_parentModule->get_template_dir());
		}
		catch (Exception $e)
		{
			Debug::log($e->getMessage());
		}
	}

	/**
	 * Add a template.
	 *
	 * @param string $name
	 */
	function addTemplate($name)
	{
		try
		{
			ViewLoader::engine()->addTemplate($name, $this->_parentModule->config('template_ns'));
		}
		catch (Exception $e)
		{
			Debug::log($e->getMessage());
		}
	}

	/**
	 * Load language. Should find it in the respective languages directory.
	 *
	 * @param string $filename
	 * @param bool $forceReload
	 */
	function loadLanguage($filename, $forceReload = false)
	{
		try 
		{
			// If a full filename was passed in, just load it directly
			if (file_exists($filename))
				Language::getLanguage()->load($filename, $forceReload);
			else
				Language::getLanguage()->load($this->_parentModule->get_language_dir() . $filename, $forceReload);
		}
		catch (Exception $e)
		{
			Debug::log($e->getMessage());
		}
	}

	/**
	 * Add a CSS file to the output.
	 *
	 * @param string $filename
	 * @param array $options
	 */
	public function load_css_file($filename, $options = array())
	{
		if (strpos($filename, 'http://') === false || !empty($options['local']))
			$filename = $this->_parentModule->get_template_dir() . '/css/' . $filename;

		ViewLoader::engine()->load_css_file($filename, $options);
	}

	/**
	 * Add a Javascript file to the output.
	 *
	 * @param string $filename
	 * @param array $options, possible parameters:
	 * 	- local (true/false): define if the file is local
	 * 	- defer (true/false): define if the file should be load in head or before the closing <html> tag
	 */
	public function load_js_file($filename, $options = array())
	{
		if (strpos($filename, 'http://') === false || !empty($options['local']))
			$filename = $this->_parentModule->get_template_dir() . '/scripts/' . $filename;

		ViewLoader::engine()->load_js_file($filename, $options);
	}

	/**
	 * Return the parent Module.
	 *
	 * @return \smCore\model\Module
	 */
	public function getParentModule()
	{
		return $this->_parentModule;
	}

    /**
     * Set the parent module
     *
     * @param $module
     */
	public function setParentModule($module)
	{
		if (!empty($module) && $module instanceof Module)
			$this->_parentModule = $module;
	}

	/**
	 * Retrieve the current action.
	 *
	 * @return Action
	 */
	public function getAction()
	{
		return $this->_action;
	}

	/**
	 * Method called before dispatching to the action handler method.
	 * It allows any setting up the handler may need, such as loading language files or checking custom permissions,
	 * before actually executing the action.
	 *
	 * @abstract
	 */
	public abstract function preDispatch();

	/**
	 * Method called after the action handler has been executed.
	 * This method is performed by the core, after executing an action handler (on normal exit).
	 * Allows cleanup, for example. Or custom hooks/events implemented by the module.
	 *
	 * @abstract
	 */
	public abstract function postDispatch();
	
	/**
 	* Load the model class $model, found in the module $module.
 	* Convenience method.
 	*
 	* @param Module $module
 	* @param string $model
 	*/
	public static function loadModel($module, $model)
	{
		// might want to do this standalone
		try
		{
			$model = $module->getModel();
		}
		catch (Exception $e)
		{
			Debug::log($e->getMessage());
		}
	}
}



