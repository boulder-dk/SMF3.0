<?php

/**
 * Test class
 */

namespace smCore;
use smCore\Language;

class LanguageTest extends \PHPUnit_Framework_TestCase
{
	protected $object = null;

	protected function setUp()
	{
		$this->object = new Language('French');
	}

	public function testGet()
	{
	}

	public function testLoad()
	{

	}

	public function testKeyExists()
	{
	}

	public function test_getFromFile()
	{
	}

	public function test_addStrings()
	{
	}

	public function testGetDefaultLanguage()
	{
	}

	public function testGetUserLanguage()
	{
	}

	public function testGetLanguage()
	{
	}
}