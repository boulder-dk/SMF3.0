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

namespace smCore;
use smCore\security\Session, smCore\security\SessionValidator, smCore\events\Event, smCore\Configuration;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
	protected $object = null;

	protected function setUp()
	{
		$this->object = Response::getInstance();
	}

	public function testGetHeaders()
	{
	}

	public function testAaddHeader()
	{
	}

	public function testGetBody()
	{
	}

	public function testDetectServer()
	{
	}

	public function testHas_fix_header()
	{
	}

	public function testSet_fix_header()
	{
	}

}
