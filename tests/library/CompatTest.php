<?php

/**
 * Test class
 */

use smCore\cache\psr\PsrCache, \Compat;

class CompatTest extends \PHPUnit_Framework_TestCase
{
	protected $object;

	/**
	 * Sets up the fixture.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		// $this->object = new Compat();
		if (!defined('SMCORE'))
			define ('SMCORE', 1);
	}

	protected function tearDown()
	{
		PsrCache::instance()->flush();
	}

	public function testCache_get_data()
	{
		$key = 'test_compat';
		$data = 'compatibility function test';

		cache_put_data($key, $data);
		$getit = cache_get_data($key);
		$this->assertEquals($data, $getit);

		// invalidate:
		$item = PsrCache::instance()->getCache($key);
		$item->remove();

		$getit = cache_get_data($key);
		$this->assertNotEquals($data, $getit);
		$this->assertEquals($getit, '');
	}

	public function testCache_put_data()
	{
		$key = 'test_compat2';
		$data = 'compatibility function test';

		cache_put_data($key, $data);
		$getit = cache_get_data($key);
		$this->assertEquals($data, $getit);
		// put null
		cache_put_data($key);
		$getit = cache_get_data($key);
		$this->assertNotEquals($data, $getit);
		$this->assertEquals($getit, '');
	}
}
