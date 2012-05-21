<?php

/**
 * Test class
 */

namespace smCore;
use smCore\Application, smCore\events\Event, smCore\model\Role, smCore\model\Permission, smCore\model\Group,
	smCore\FatalException, smCore\model\User, smCore\AccessManager;

/**
 * AccessManager class is the point of entry of access and permission checks to resources.
 *
 * Permissions model is very different in the ACL-based system and SMF system.
 * What can be called a "global permission" applies to actions, certain items (such as own vs any posts/comments),
 * various resources (such as posts, files, profile avatars etc).
 * Permissions profiles in SMF 2 further define local permissions taking precendence where applicable.
 * Post-count groups are also treated differently by the forum.
 * Certain groups are treated differently, again, such as 'local moderators'.
 *
 * The impedance mismatch is too significant to consider refactoring SMF 3.0 at this level, while an ACL-based
 * interface is appropriate for future versions.
 *
 * For compatibility with SMF, the purpose of this class is now meant to simply define the same consistent
 * interface for an ACL based system it was doing from the start, in the measure of possible, however this
 * interface won't be used for a while.
 * Instead, the class will gather the applicable methods or functions it needs to make available to the forum module.
 * The additional purpose of this class and helpers (Permission, Role/Group, Action) is to design and implement
 * in time adapters from the forum module model, to the ACL model.
 */
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

