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

/**
 * Default autoloader.
 * Registers paths from smCore, modules, and additional libraries, to load the files.
 * This autoloader is intended as PSR-0 compliant.
 * Note that this autoloader will NOT require files, thereby allowing for further
 * autoloaders that may be registered in the stack to attempt to load the classes.
 * Source: https://wiki.php.net/rfc/splclassloader
 */
class DefaultAutoloader
{
	const NS_SEPARATOR = '\\';
	const PREFIX_SEPARATOR = '_';

	private $_libraryPath = '';
	private $_libraries = array();
	private $_includePath = false;

	/**
	 * Once registered, this method is called by the PHP engine when loading a class.
	 * It allows us to figure out where the class is, based on our setup of directories and files,
	 * and have the respective file included.
	 * This method is compatible with the PSR-0 specification.
	 * The implementation allows for include path.
	 * It will not require() class files.
	 * This allows for eventual additional autoloaders to succeed.
	 *
	 * @param $name
	 * @throws Exception currently throws an exception when the class is not found.
	 */
	public function load($name)
	{
		$filename = $this->get_filename($name);
		if (file_exists($filename))
		{
			include_once $filename;
			return true;
		}
		else
		{
			foreach ($this->_libraries as $library => $directories)
			{
				if (strpos($filename, $library) !== 0)
					continue;
				foreach ($directories as $directory)
				{
					$absolutePath = $directory . DIRECTORY_SEPARATOR . $filename;
					if (file_exists($absolutePath))
					{
						include_once $absolutePath;
						return true;
					}
				}
			}
		}

		if ($this->has_include_path())
		{
			$filename = stream_resolve_include_path($filename);
			if ($filename !== false)
				include_once $filename;
		}

		// currently throw an exception
		throw new Exception("Class $name not found in directories: " . var_dump($this->_directories));
	}

	/**
	 * Retrieve the (relative) filename corresponding to this className
	 *
	 * @param string $className
	 */
	public function get_filename($className)
	{
		// Most classes will be namespaced
		// Identify NS
        $matches = array();
        preg_match('/(?P<namespace>.+\\\)?(?P<class>[^\\\]+$)/', $className, $matches);

        $class = (isset($matches['class'])) ? $matches['class'] : '';
        $namespace = (isset($matches['namespace'])) ? $matches['namespace'] : '';

        if (!empty($namespace))
        	return $this->_libraryPath
            	. str_replace(self::NS_SEPARATOR, '/', $namespace)
            	. str_replace(self::PREFIX_SEPARATOR, '/', $class)
            	. '.php';
        else
        	return $class . '.php';
	}

	/**
	 * Register our autoloader.
	 *
	 * @param boolean $prepend Whether to prepend the autoloader in autoloaders list.
	 * @return bool
	 */
	public function register($prepend = false)
	{
		return spl_autoload_register(array($this, 'load'), true, $prepend);
	}

	/**
	 * Unregister our autoloader.
	 *
	 * @return bool
	 */
	public function unregister()
	{
		return spl_autoload_unregister(array($this, 'load'));
	}

	/**
	 * Add directory or directories to the autoloader path.
	 * In particular to be used for additional libraries directories.
	 * It may be used for modules.
	 *
	 * Allows for multiple directories to be mapped to a namespace.
	 *
	 * @param $library
	 * @param $directories
	 */
	public function add_library($library, $directories)
	{
		// Add $directories to the path
		$this->_libraries[$library] = array($directories);
	}

	/**
	 * Main application path.
	 *
	 * @param string $libraryPath
	 */
	public function set_library_path($libraryPath)
	{
		$this->_libraryPath = $libraryPath;
		$this->add_library('smCore', $this->_libraryPath);
	}

	/**
	 * Retrieve the known main library path.
	 * This is the default directory classnames/namespaces are resolved
	 * against.
	 */
	public function get_library_path()
	{
		return $this->_libraryPath;
	}

	/**
	 * Whether to add include path when searching for class files.
	 *
	 * @param boolean $includePathLookup
	 */
	public function add_include_path($includePath)
	{
		$this->includePath = $includePath;
	}

	/**
	 * Whether PHP include path should be used.
	 *
	 * @return boolean
	 */
	public function has_include_path()
	{
		return $this->includePath;
	}
}