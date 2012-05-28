<?php

/**
 * smCore platform
 *
 * @package smCore
 * @author Fustrate
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

use smCore\Application, smCore\Request, smCore\storage\Storage,
	smCore\cache\Pool, smCore\cache\CacheItem;

class Compat
{}

	/**
	 * Returns the corresponding timestamp.
	 *
	 * @static
	 * @param $date
	 * @param null $time
	 * @return bool|int
	 */
	function getTimestamp($date, $time = null)
	{
		if (!preg_match('~^(0?[1-9]|1[0-2])([/\.\- ])(0?[1-9]|[12][0-9]|3[01])\2([0-9]{4})$~', $date, $matches))
			return false;

		$month = (int) $matches[1];
		$day = (int) $matches[3];
		$year = (int) $matches[4];

		$hours = 0;
		$minutes = 0;
		$seconds = 0;

		if ($time !== null)
		{
			if (preg_match('~^(1[0-2]|0?[1-9]) ([ap]m)$~', $time, $matches))
			{
				$hours = (int) $matches[1];
				$ampm = $matches[2];
			}
			else if (preg_match('~^(1[0-2]|0?[1-9]):([0-5][0-9]) ([ap]m)$~', $time, $matches))
			{
				$hours = (int) $matches[1];
				$minutes = (int) $matches[2];
				$ampm = $matches[3];
			}
			else if (preg_match('~^(1[0-2]|0?[1-9]):([0-5][0-9]):([0-5][0-9]) ([ap]m)$~', $time, $matches))
			{
				$hours = (int) $matches[1];
				$minutes = (int) $matches[2];
				$seconds = (int) $matches[3];
				$ampm = $matches[4];
			}
			else
				return false;

			if ($ampm == 'pm' && $hours != 12)
				$hours += 12;
			else if ($hours == 12 && $ampm == 'am')
				$hours = 0;
		}

		if (!checkdate($month, $day, $year))
			return false;

		return mktime($hours, $minutes, $seconds, $month, $day, $year);
	}

	/**
	 * Convert a timestamp to a date array
	 *
	 * @static
	 * @param $timestamp
	 * @return array
	 */
	function makeDateArray($timestamp)
	{
		return array(
			'month' => date('n', $timestamp),
			'day' => date('j', $timestamp),
			'year' => date('Y', $timestamp),
			'time' => date('g:i A', $timestamp),
			'time_full' => date('g:i:s A', $timestamp),
			'raw' => $timestamp,
		);
	}

	/**
	 * Random string.
	 *
	 * @static
	 * @param $length
	 * @param string $set
	 * @return string
	 */
	function randString($length, $set = 'hex')
	{
		if ($set == 'alphanum')
			$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		else if ($set == 'full')
			$characters = 'aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ0123456789!@#$%&*:;';
		else
			$characters = 'abcdef0123456789';

		$string = '';

		for ($i = 0; $i < $length; $i++)
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];

		return $string;
	}

	/**
	 * Convert and escape a string for javascript
	 *
	 * @param string $string
	 */
	function JavaScriptEscape($string)
	{
		$scripturl = Request::scripturl();

		return '\'' . strtr($string, array(
			"\r" => '',
			"\n" => '\\n',
			"\t" => '\\t',
			'\\' => '\\\\',
			'\'' => '\\\'',
			'</' => '<\' + \'/',
			'script' => 'scri\'+\'pt',
			'<a href' => '<a hr\'+\'ef',
			$scripturl => '\' + smf_scripturl + \'',
		)) . '\'';
	}

function database()
{
	return Storage::database();
}

/**
 * Compatibility function.
 * Retrieve data from cache, if it exists.
 * Delegates to the Cache subsystem.
 * The purpose of this code is to test the use the standard Cache
 * interfaces, doing much more work than needed right now.
 * Up for benchmark, testing and refactoring.
 *
 * @param string $key
 */
function cache_get_data($key)
{
	$item = Pool::instance()->getCache($key);
	if ($item->isMiss())
		return false;
	else
		return $item->value();
}

/**
 * Compatibility function.
 * Cache data through the Cache subsystem.
 * Delegates to the Cache subsystem.
 *
 * @param string $key
 * @param int|DateInterval|null $ttl
 */
function cache_put_data($key, $data = null, $ttl = null)
{
	$item = Pool::instance()->getCache($key);
	if ($item->isMiss())
		$item->set($data, $ttl);
}