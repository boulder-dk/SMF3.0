<?php

/**
 * Test class
 */

namespace smCore;
use smCore\Application;

class ApplicationTest extends \PHPUnit_Framework_TestCase {

	protected $object = null;

	protected function setUp()
	{
		$this->object = Application::getInstance();
	}

	public function testGetInstance()
	{
		$anotherObject = Application::getInstance();
		$this->assertEquals($anotherObject, $this->object);
	}

	public function testBoot()
	{
	}

	public function testDetectBrowser()
	{

	}

	public function testIsBrowser()
	{

	}

	public function testAddToContext()
	{
	}

	public function testAddValueToContext()
	{
	}

	public function testSetValueToContext()
	{

	}

	public function testContext()
	{

	}

	public function testGetStartTime()
	{
	}

	public function testSet()
	{
	}

	public function testGet()
	{
	}

}