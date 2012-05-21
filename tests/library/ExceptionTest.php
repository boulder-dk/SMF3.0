<?php

/**
 * Test class
 */

namespace smCore;
use smCore\Exception;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new Exception();
	}

}