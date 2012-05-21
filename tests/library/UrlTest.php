<?php

/**
 * Test class
 */

namespace smCore;
use smCore\Url;

class UrlTest extends \PHPUnit_Framework_TestCase
{
	protected $object = null;

	protected function setUp()
	{
		$this->object = Url::getInstance();
	}

	public function getHasNext()
	{
	}

	public function getGetNext()
	{
	}

	public function getPeekNext()
	{
	}

	public function getGetByIndex($index)
	{
	}

	public function getGetQueryString()
	{
	}
}