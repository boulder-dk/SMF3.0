<?php

/**
 * Interface to a payment gateway.
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

namespace smCore\modules\subscriptions\model;
use smCore\Application, smCore\model\Module, smCore\Request, smCore\handlers\ActionController,
	smCore\Response, smCore\security\Session, smCore\Language;

/**
 * Payment gateway.
 * Payment gateways implement this interface.
 *
 */
interface Gateway
{
	public abstract function getName();
	public abstract function getFields();
	public abstract function getSettings();
	public abstract function authData();
}