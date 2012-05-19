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
 * Portions created by the Initial Developer are Copyright (C) 2011
 * the Initial Developer. All Rights Reserved.
 *
 * @version 1.0 alpha
 */

namespace smCore\modules\filemanager\controllers;
use smCore\Application, smCore\handlers\ActionController;

/**
 * File manager main controller.
 */
class FileManagerController extends ActionController
{
	/**
	 * Instantiate this controller, with a reference to the parent module, to provide it services.
	 *
	 * @param $parentModule
	 */
	public function __construct($action, $parentModule)
	{
		parent::__construct($action, $parentModule);
	}

	/**
	 * Main - display the file manager home page.
	 */
	function mainAction()
	{
		$module = $this->_parentModule;
		$this->loadTemplates('main');
		$this->addTemplate('main');

		Application::addValueToContext('page_title', $module->lang('titles_main'));
	}

	/**
	 * This method is performed always, by the core, before calling an action handler.
	 */
	public function preDispatch()
	{
		$this->loadLanguage('english.us.yaml');
	}

	/**
	 * This method is performed by the core, after executing an action handler (on normal exit).
	 * Allows cleanup, for example. Or custom hooks/events implemented by the module.
	 */
	public function postDispatch()
	{
		// TODO: Implement postDispatch() method.
	}

	/**
	 * Lists all packages or files (with paging).
	 * Listing per category.
	 */
	public function listAction()
	{
		// TODO: Implement listAction()
	}

	/**
	 * Edit a category. This is an action that requires special permissions.
	 * Common page for different types, so it should have a switch to specify/change to which the category applies.
	 */
	public function editCategoryAction()
	{
		// TODO: Implement editCategoryAction()
	}

	/**
	 * Browse (list) packages or files by category.
	 * Common page for mods and themes.
	 */
	public function browseCategoryAction()
	{
		// TODO: Implement browseCategoryAction()
	}

	/**
	 * Add a new category.
	 * Common page for mods and themes, so it should have a switch to specify to which it applies.
	 */
	public function addCategoryAction()
	{
		// TODO: Implement addCategoryAction()
		// it's a sort of edit, really, but most common code will probably be in models/storage anyway.
	}

	/**
	 * Search page display, and the form for search parameters.
	 */
	public function searchAction()
	{
		// TODO: Implement searchAction()
	}

	/**
	 * Actually do the search.
	 */
	public function doSearchAction()
	{
		// TODO: Implement doSearchAction()
	}

	/**
	 * Download a package.
	 * Might not be needed?
	 */
	public function downloadAction()
	{
		// TODO: Implement downloadAction()
	}

	/**
	 * Settings page. Allows to edit settings.
	 */
	public function editSettingsAction()
	{
		// TODO: Implement settingsAction()
	}

	/**
	 * Perform the settings modifications.
	 */
	public function doEditSettingsAction()
	{
		// TODO: Implement editSettingsAction()
	}
}