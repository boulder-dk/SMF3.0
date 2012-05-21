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
use smCore\security\RequestValidator;

class RequestTest extends \PHPUnit_Framework_TestCase
{
	protected $object = null;

	protected function setUp()
	{
		$this->object = Request::getInstance();
	}

	public function testCleanRequest()
	{

	}

	public function testUrl()
	{
	}


	public function testGetRequestMethod()
	{
	}

	public function testIsXmlHttpRequest()
	{
	}

	public function testRedirect()
	{

	}


	public function testScheme()
	{
	}


	public function testGetServerValue()
	{
	}


	public function testGetPostValue()
	{
	}


	public function testGetPost()
	{
	}


	public function testGetGetValue()
	{
	}


	public function testHasGetParams()
	{
	}


	public function testGetCookieValue()
	{
	}


	public function testUnsetCookieValue()
	{
	}


	public function testGetClientIp()
	{
	}

	public function testGetRequestHeader()
	{
	}

	public function testScripturl()
	{
	}

	public function testGetInstance()
	{

	}
}
