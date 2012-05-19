<?php

/**
 * smCore platform
 *
 * @package smCore
 * @author Compuart
 * @license MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version 1.1
 * (the "License"); you may not use this package except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * The Original Code is smCore.
 *
 * The Initial Developer of the Original Code is Compuart.
 *
 * Portions created by the Initial Developer are Copyright (C) 2012
 * the Initial Developer. All Rights Reserved.
 *
 * @version 1.0 alpha
 */

namespace smCore\security;

/**
 * An Action, the generic action that is being performed.
 * Any action is mapped to an Action instance, for parameters sanitization,
 * validation and operations such as building some redirects.
 * The credit for the original concept belongs to Compuart from forms approach.
 */
use smCore\Exception;

class Action 
{
	/**
	 * Base URL to use, when building redirects or target actions.
	 * @var string
	 */
	private $_scripturl = null;
	/**
	 * The $_GET parameters this action can have.
	 * Other parameters will be filtered out, and an exception thrown.
	 * @var array
	 */
	private $_params = null;
	/**
	 * The name of this action.
	 * @var string
	 */
	private $_action = '';
	/**
	 * The name of the current subaction.
	 * @var string
	 */
	private $_subaction = '';
	/**
	 * Parameters replacements.
	 * @var array
	 */
	private $_urlParams = null;
	/**
	 * For secure actions, unique token.
	 * @var string
	 */
	private $_nonce;
	/**
	 * Whether this action is a secure action.
	 * (an action that needs extra-token checks)
	 * @var bool
	 */
	private $_secure;
	/**
	 * Good ole' singleton instance.
	 * (this may be removed.)
	 * @var Action
	 */
	private static $_instance = null;

	/**
	 * Creates an Action object.
	 * It may be linked to a form.
	 * 
	 * @param $action string
	 * @param $subaction string
	 * @param \smCore\views\GenericForm $form = null
	 */
	private function __construct($action, $subaction = '', $secure = false, $form = null)
	{
		$this->_action = $action;
		$this->_subaction = $subaction;
		$this->_secure = $secure;
	}

	/**
	 * Return all registered subactions of an Action.
	 */
	public function getSubactions()
	{
		// @todo
		// Will this hold its subactions?
		// Only if the controller would dispatch, which it doesn't.
	}

	/**
	 * Static initializer of an Action.
	 * 
	 * @param string $action
	 * @param string $subaction
	 * @throws LogicException
	 */
	public static function initialize($action, $subaction)
	{
		if (empty(self::$_instance))
			self::$_instance = new Action($action, $subaction);
		else throw new LogicException('Action initialized twice');
	}

	/**
	 * Create a URL of the given parameters.
	 * This builds a redirect URL to be used where necessary.
	 *
	 * @return string
	 */
	public function getHref()
	{
		$URL = $this->_scripturl . '?';
		foreach ($this->_params as $key => $value)
			$URL .= urlencode($key) . '=' . urlencode($value) . ';';

		return substr($URL, 0, -1);
	}

	/**
	 * Make sure to filter the params from what we got,
	 * sanitizing them in the process.
	 */
	public function filterParams()
	{
		// Check whatever we got from the environment
		if (!empty($this->_params))
			foreach ($this->_params as $param => $type)
				$this->filterParam($param, isset($_GET[$param]) ? $_GET[$param] : null);
	}

	/**
	 * Filters URL parameters values.
	 * Stores them in $this instance.
	 * int parameters will be sanitized.
	 * String parameters will stored and urlencoded.
	 *
	 * @param string $paramKey - enumeration of 'int', 'string'
	 * @param mixed $paramValue, string or int
	 */
	public function filterParam($paramKey, $paramValue)
	{
		if (!isset($this->_params[$paramKey]))
			throw new Exception('Parameter ' . $paramKey . ' isn\'t configured in the action.');

		switch ($this->_params[$paramKey]) {
			case 'int':
				$this->_params[$paramKey] = isset($paramValue) ? (int) $paramValue : 0;
				$this->_urlParams['{' . $paramKey . '}'] = $this->_params[$paramKey];
				break;

			case 'string':
				$this->_params[$paramKey] = isset($paramValue) ? $paramValue : '';
				$this->_urlParams['{' . $paramKey . '}'] = urlencode($this->_params[$paramKey]);
				break;

			default:
				throw new Exception('Unknown parameter type given.');
				break;
		}
	}

	/**
	 * Check nonce for secure actions.
	 * 
	 * @return bool
	 */
	function checkNonce() 
	{
		// @todo check nonce for secure actions.
	}
	
	/**
	 * Whether this is a secured action.
	 * 
	 * @return bool
	 */
	public function isSecure()
	{
		return $this->_secure;
	}

}
