<?php

/**
 * Test class
 */
namespace smCore\cache\psr;
use smCore\logging\Debug;

use smCore\cache\psr\PsrCache;

class NullCachePoolTest extends \PHPUnit_Framework_TestCase
{
	protected $object;

	/**
	 * Sets up the fixture.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		$this->object = new NullCachePool(array());
	}

	protected function tearDown()
	{
		$this->object->flush();
	}

	public function testFlush()
	{
		$key = 'psr_test 5';
		$item = $this->object->getCache($key);
		$this->assertFalse($item->set('random value ' . rand(1, 200)));
		$this->object->flush();

		$item2 = $this->object->getCache($key);
		$this->assertTrue($item2->isMiss());
	}

	public function testGetCache()
	{
		$key = 'psr_test';
		$item = $this->object->getCache($key);
		$this->assertTrue($item->isMiss());
		$this->assertTrue($item->get() === null);

		$this->assertFalse($item->set('random value ' . rand(1, 200)));

		$item2 = $this->object->getCache($key);
		$this->assertTrue($item->isMiss());

	}

	public function testGetCacheIterator()
	{
		$this->object->flush();

		$item1 = $this->object->getCache('item1');
		$item2 = $this->object->getCache('item2');
		$item2->set(randString(15, 'abc'));
		$item3 = $this->object->getCache('item3');
		$item4 = $this->object->getCache('item4');
		$item4->set(rand(1, 500));

		$keys = array(
			$item1->getKey(), $item2->getKey(), $item4->getKey()
		);
		$iterator = $this->object->getCacheIterator($keys);
		$this->assertFalse($iterator->valid());
	}
}
