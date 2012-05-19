<?php

namespace smCore\modules\filemanager\model;
use smCore\Application;

/**
 * This class handlers operations on files (packages), directories, downloading and uploading.
 */
class FileModel
{
	const SMF_MOD_PACK = 0;
	const SMF_THEME_PACK = 1;
	const SMF_LANGUAGE_PACK = 2;
	const SMF_CONVERTER_PACK = 3;
	const SMF_BRIDGE_PACK = 4;
	const MODULE_PACK = 5;
	const PLUGIN_PACK = 6;
	const LANGUAGE_PACK = 7;
	const CONVERTER_PACK = 8;

	/**
	 * Make an instance of it.
	 *
	 */
	public function __construct()
	{
	}

	/**
	 * Retrieve files information, i.e. packages, according to the parameters passed.
	 */
	public function getFiles()
	{
		// TODO: implement getFiles() method.
	}

	/**
	 * Retrieves categories. (customizable by type of file/package)
	 *
	 * @param int $type=FileModel::MODULE_PACK
	 */
	public function getCategories($type = self::MODULE_PACK)
	{
		// TODO: implement getCategories() method.
	}

	/**
	 * Retrieve the settings for filemanager module
	 */
	public function getSettings()
	{
		// TODO: implement getSettings() method.
	}

	/**
	 * Modify the settings to the given values.
	 * Settings are expected passed as an array of key/value pairs.
	 *
	 * @param array $settings
	 */
	public function setSettings($settings)
	{
		// TODO: implement setSettings() method.
	}

}