<?php

/**
 * Test class
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
