<?php

namespace smCore\cache\psr;
use smCore\logging\Debug;

use smCore\cache\psr\PsrCache;

class PsrCacheTest extends \PHPUnit_Framework_TestCase
{
	protected $object;

	/**
	 * testInstance().
	 */
	public function testInstance() {
		$test = PsrCache::instance();
		$this->assertEquals(get_class($test), 'smCore\cache\psr\FileCachePool');
	}
}