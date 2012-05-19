<?php

/**
 * Subscriptions action controller.
 *
 * @package subscriptions
 * @author Simple Machines and contributors
 * @license  MPL 1.1
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
 * @version 1.1
 */

namespace smCore\modules\auth\controllers;
use smCore\Application, smCore\model\Module, smCore\Request, smCore\handlers\ActionController,
	smCore\Response, smCore\security\Session, smCore\Language;

/**
 * This class handles subscription-related actions.
 */
class SubscriptionController extends ActionController
{
	/**
	 * Instantiate this controller, with a reference to the parent module, to provide its services.
	 *
	 * @param $action
	 * @param $parentModule
	 */
	public function __construct($action, $parentModule)
	{
		parent::__construct($action, $parentModule);
	}
	
	/**
	 * Show the payment gateway details.
	 */
	public function displayAction()
	{
		$module = $this->getParentModule();
		$this->loadTemplates('subscriptions');
		$this->addTemplate('gateway');

		$this->_context['page_title'] = $module->lang('gateway_title');
		
		// load the subscription model (gateway data)
		// display the data
	}
	
	/**
	 * User subscribe action.
	 */
	public function subscribeAction()
	{
		$module = $this->getParentModule();
		$this->loadTemplates('subscriptions');
		
		// init user action
		// load gateway data
		
	}

	/**
	 * Process response from the gateway
	 * This is routed from the $returnURL sent to us
	 */
	public function subscribedAction()
	{
		// needs a better name
		// receives response from the gateway
		// process and validate it
		// send notifications to dependent modules
	}
	
    /**
     * Method called after the action handler has been executed.
     */
    public function postDispatch()
    {
        // @todo: Implement postDispatch() method.
        // clean-up, notifications
    }

    /**
     * Load the language strings before dispatch.
     */
    function preDispatch()
    {
    	// we always need to speak some language.
        $this->loadLanguage('subscriptions');
    }

	private function _initGatewayForm()
	{
		//
	}
	
}