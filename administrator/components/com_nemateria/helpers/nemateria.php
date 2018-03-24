<?php

/**
 * @version		$Id: nemateria.php 9 2012-02-14  labxxi $
 * @package		NEMATERIA v2.5
 * @subpackage	Component
 * @copyright	Copyright (C) 2010-today Labxxi. All rights reserved.
 * @author		Labxxi
 * @link		http://labxxi.com
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */


// No direct access to this file
defined('_JEXEC') or die('Restricted access');
jimport('joomla.language.language');

/**
 * NEMATERIA component helper.
 */
abstract class NemateriaHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param	string	$submenu	the name of the current submenu
	 *
	 * @return void
	 */
	public static function addSubmenu($submenu) 
	{
	    // Addsubmenu
		JSubMenuHelper::addEntry(JText::_('COM_NEMATERIA_SUBMENU_WELCOME'), 'index.php?option=com_nemateria&view=accueil', $submenu == 'accueil');
        JSubMenuHelper::addEntry(JText::_('COM_NEMATERIA_SUBMENU_ENTREPOT_ALT'), 'index.php?option=com_nemateria&view=entrepots', $submenu == 'entrepots');
        JSubMenuHelper::addEntry(JText::_('COM_NEMATERIA_SUBMENU_COLLECTIONS'), 'index.php?option=com_nemateria&view=collections', $submenu == 'collections');
        JSubMenuHelper::addEntry(JText::_('COM_NEMATERIA_SUBMENU_NOTICES'), 'index.php?option=com_nemateria&view=notices', $submenu == 'notices');

		// set some global property
		$document = JFactory::getDocument();
		$document->setTitle(JText::sprintf('COM_NEMATERIA_PAGETITLE', JFactory::getConfig()->get('sitename'), JText::_('COM_NEMATERIA_PAGETITLE_' . $submenu)));
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param	int		$categoryId	L'ID de la catégorie.
	 * @param	int		$entrepotId	L'ID de l'entrepot.
	 *
	 * @return	JObject
	 */
	public static function getActions($categoryId = 0, $entrepotId = 0)
	{
		echo " / Helper getaction activé";
		// Get the current user
		$user = JFactory::getUser();

		// Prepare the result
		$result = new JObject;
		if (empty($entrepotId))
		{
			if (empty($categoryId)) 
			{
				$assetName = 'com_nemateria';
			}
			else
			{
				$assetName = 'com_nemateria.category.' . (int)$categoryId;
			}
		}
		else
		{
			$assetName = 'com_nemateria.entrepots.' . (int)$entrepotId;
		}
		$actions = array('core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete');
		foreach($actions as $action) 
		{
			// Get the authorised actions
			$result->set($action, $user->authorise($action, $assetName));
		}
		return $result;
	}

	/**
	 * Create title tables for dealing with different language collation
	 *
	 * @param	$array	$array	an array of language tags
	 *
	 * @return void
	 */
	public static function createTitleTables($tags = array()) 
	{
		// Get the DB object
		$db = JFactory::getDBO();

		// Loop for each tags
		foreach($tags as $tag) 
		{
			// Get the collation for this tag
			$collation = self::getCollation($tag);

			// Get the table name using the DB prefix
			$name = $db->getPrefix() . 'nemateria_entrepot_variants_' . $tag;

			// Get information about this table
			$query = 'SHOW TABLE STATUS WHERE Name=' . $db->quote($name);
			$db->setQuery($query);
			$table = $db->loadObject();
			if (!$table) 
			{
				// Table is not found
				$create = 'CREATE TABLE `' . $name . '` (';
				$create.= '		`eid`		integer unsigned	NOT NULL COMMENT ' . $db->quote('FK to the #__nemateria_entrepot table') . ',';
				$create.= '		`alternate`	varchar(255)		NOT NULL COLLATE ' . $collation . ',';
				$create.= '		`ordering`	integer				NOT NULL default 0,';
				$create.= '		KEY 	`idx_eid`	(`eid`),';
				$create.= '		UNIQUE	`idx_alternate`	(`alternate`),';
				$create.= '		KEY 	`idx_ordering`	(`ordering`)';
				$create.= ') COLLATE ' . $collation;
				$db->setQuery($create);
				$db->query();
			}
			elseif ($collation != $table->Collation) 
			{
				// Table is found and current collation is not correct
				$alter = 'ALTER TABLE `' . $name . '` CHARACTER SET utf8 COLLATE ' . $collation;
				$db->setQuery($alter);
				$db->query();
				$alter = 'ALTER TABLE `' . $name . '` MODIFY `alternate` varchar(255) NOT NULL COLLATE ' . $collation;
				$db->setQuery($alter);
				$db->query();
			}
		}
	}

	/**
	 * Get the collation for a given language tag
	 *
	 * @param	string	$tag	A language tag
	 *
	 * @return string	The collation used
	 */
	public static function getCollation($tag) 
	{
		// In J!1.7, mysql collation must be part of the xml language description file
		// In J!1.6, get the collation from the language ini files

		$lang = JLanguage::getInstance(false);
		$lang->load('com_nemateria', JPATH_ADMINISTRATOR, null, false, false) || $lang->load('com_nemateria', JPATH_ADMINISTRATOR, $lang->getDefault(), false, false);
		$collation = $lang->get('collation', $lang->_('COM_DICTIONARY_MYSQL_COLLATION'));

		// Get the DB object
		$db = JFactory::getDBO();

		// Get collation description
		$query = 'SHOW COLLATION WHERE Collation=' . $db->quote($collation);
		$db->setQuery($query);
		$result = $db->loadObject();

		// If the collation has not been found
		if (empty($result)) 
		{
			// Fallback to default collation
			$collation = 'utf8_unicode_ci';
		}
		return $collation;
	}
}
