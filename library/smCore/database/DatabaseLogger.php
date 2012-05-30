<?php

/**
 * smCore platform
 *
 * @package database
 * @license MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version 1.1
 * (the "License"); you may not use this package except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * The Original Code is smCore.
 *
 * The Initial Developer of the Original Code is Simple Machines and contributors.
 *
 * Portions created by the Initial Developer are Copyright (C) 2012
 * the Initial Developer. All Rights Reserved.
 *
 * @version 1.0 alpha
 *
 */

namespace database;
use smCore\storage;

/**
 * Simple database logger class.
 * The database adapters (database/XxxYyyAdapter.php) use it to log their messages or queries.
 */
class DatabaseLogger
{
    private $_queryCount = 0;
	private $_messages = array();
	private $_queries = array();

    /**
     * Increment query count
     */
	public function addQueryCount()
	{
		$this->_queryCount++;
	}

	/**
	 * Log a message in the database log.
	 *
	 * @param $message
	 */
	public function logMessage($message)
	{
		$this->_messages[] = $message;
	}

	/**
	 * Log a query in the query log.
	 * The query should be sent as a fully formed string. To log raw queries and their parameters,
	 * use logRawQuery() method.
	 *
	 * @param $query
	 * @param $file
	 * @param $line
	 * @param $start
	 */
	public function logQuery($query, $file, $line, $start)
	{
		// Don't overload it.
		if ($this->_queryCount < 50)
			$this->_queries[] = array(
				'query' => $query,
				'file' => $file,
				'line' => $line,
				'start' => $start
				);
	}

	/**
	 * Log the query as it's being prepared, along with the parameters that will be sent with it.
	 * For debugging purposes.
	 *
	 * @param $query
	 * @param $parameters
	 * @internal param $variables
	 */
	public function logRawQuery($query, $parameters)
	{
		// this won't work.
		// @todo
		$adapter = Storage::database();
		$this->_queries[] = array(
			'query' => $adapter->quote($query, $parameters),
			'parameters' => $parameters
		);
	}

    /**
     * Add previous queries to the query count
     */
	public function addPreviousQueries()
	{
		if (!empty($_SESSION['debug_redirect']))
		{
			$this->_queries = array_merge($_SESSION['debug_redirect'], $this->_queries);
			$this->_queryCount++;
			$_SESSION['debug_redirect'] = array();
		}
	}

    /**
     * Log time of the query
     *
     * @param $time
     */
	public function setQueryTime($time)
	{
		$this->_queries[count($this->_queries) - 1]['time'] = microtime(true) - $time;
	}

    /**
     * Log an error
     *
     * @param $error
     * @param string $type
     * @param string $file
     * @param int $line
     */
    public function logError($error, $type = 'default', $file = '', $line = 0)
    {
        // logError($txt['database_error'], 'database', $file, $line);
        // @todo not implemented
    }

    /**
     * Log fatal error and exit
     *
     * @param $error
     * @param $type
     */
    public function fatalError($error, $type)
    {
        // @todo not implemented
		die();
    }
}