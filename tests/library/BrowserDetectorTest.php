<?php

/**
 * smCore platform
 *
 * @package smCore
 * @author Simple Machines http://www.simplemachines.org
 * @copyright 2012 Simple Machines and contributors
 * @license http://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 3.0 Alpha 1
 */

namespace smCore;
use smCore\BrowserDetector;

class BrowserDetectorTest extends \PHPUnit_Framework_TestCase
{
	protected $object = null;

	protected function setUp()
	{
		$this->object = new BrowserDetector;
	}

	public function testDetectBrowser()
	{
	}

	public function testIsOpera()
	{
	}

	public function testIsIe()
	{
	}

	public function testIsWebkit()
	{
	}

	public function testIsFirefox()
	{

	}

	public function isWebTv()
	{
	}

	public function isKonqueror()
	{
	}

	public function isGecko()
	{
	}

	public function isOperaMini()
	{
	}

	public function isOperaMobi()
	{
	}

	public function testSetupWebkit()
	{

	}

	public function testSetupIe()
	{
	}

	public function testSetupFirefox()
	{
	}

	public function testSetupOpera()
	{
	}

	public function testSetupBrowserPriority()
	{
	}

	public function testFillInformation()
	{
	}
}