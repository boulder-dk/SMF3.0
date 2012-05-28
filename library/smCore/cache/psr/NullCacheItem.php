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
 * Contributor(s):
 */

namespace smCore\cache\psr;
use smCore\cache\psr\CacheItem, smCore\cache\psr\CachePool;

/**
 * Simple "null" Cache pool item.
 * Implementation of the PSR-Cache proposal.
 * @author norv@simplemachines.org
 */
class NullCacheItem extends CacheItem
{
	public function __construct()
	{
		parent::__construct('');
		$this->_miss = true;
		$this->_value = null;
	}

	/**
	 * @see smCore\cache\psr.Item::set()
	 */
	public function set($value, $ttl = null)
	{
		return false;
	}

	/**
	 * @see smCore\cache\psr.Item::remove()
	 */
	public function remove()
	{
		return true;
	}
}