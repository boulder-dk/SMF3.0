<?php

/**
 * Test class
 */

namespace smCore;
use smCore\AccessManager;

class AccessManagerTest extends \PHPUnit_Framework_TestCase
{
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = AccessManager::getInstance();
	}

	public function test_loadRoles()
	{

	}

	public function test_loadPermissions()
	{

	}

	public function testAddRole()
	{
		// not yet there
	}

	public function testAddResource()
	{
		//
	}

	public function testAllow()
	{
		// not yet
	}

	public function testDeny()
	{
		// not yet
	}

	public function testIsAllowed()
	{
		// not yet

	}

	function testGetGuestRole()
	{
		$guest = AccessManager::getGuestRole();
		$this->assertEquals($guest, 0);
	}

	public function testAllowedTo()
	{
		//
	}

	public function testGetInstance()
	{
		$anotherObject = AccessManager::getInstance();
		$this->assertEquals($this->object, $anotherObject);
	}
}

