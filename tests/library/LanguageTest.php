<?php

/**
 * smCore platform
 *
 * @package smCore
 * @license MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version 1.1
 * (the "License"); you may not use this package except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * The Original Code is smCore.
 *
 * The Initial Developer of the Original Code is the smCore project.
 *
 * Portions created by the Initial Developer are Copyright (C) 2012
 * the Initial Developer. All Rights Reserved.
 *
 * @version 1.0 alpha
 *
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