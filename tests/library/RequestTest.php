<?php

/**
 * Test class
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
