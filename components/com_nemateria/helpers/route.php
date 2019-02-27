<?php
/**
 * @version		$Id: route.php 170 2013-11-12 22:44:37Z michel $
 * @package		Exlineo
 * @subpackage	Helpers
 * @copyright	Copyright (C) 2014 Open Source Matters, Inc. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

// Component Helper
jimport('joomla.application.component.helper');

jimport('joomla.application.categories');
/**
 * Exlineo Component Route Helper
 *
 * @static
 * @package		Exlineo
 * @subpackage	Helpers

 */
abstract class NemateriaHelperRoute
{
	protected static $lookup;
	/**
	 * @param	int	The route of the exlineo
	 */
	public static function getNemateriaRoute($id, $id_collection)
	{
		$needles = array(
			'notices'  => array((int) $id)
		);
		//Create the link
		
		if ($id_collection > 1) {
			$categories = JCategories::getInstance('Notice');
			$category = $categories->get($id_collection);
			if ($category) {
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$id_collection;
			}
			$link = 'index.php?option=com_nemateria&view=notices&id_notice='. $id;
		}else{
			$link = 'index.php?option=com_nemateria&view=notice&id_notice='. $id;
		}

		if ($item = NemateriaHelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item;
		};

		return $link;
	}


	/**
	 * Returns link to category view  
	 * @param JCategoryNode $id_collection
	 * @param number $language
	 * @return string
	 */

	public static function getCategoryRoute($id_collection, $language = 0)
	{
		
		
		if ($id_collection instanceof JCategoryNode)
		{
			$id = $id_collection->id;
			$category = $id_collection;
		}
		else
		{			
			throw new Exception('First parameter must be JCategoryNode');			
		}
	
		$catviews = NemateriaHelper::getCategoryViews();
		$extensionviews = array_flip($catviews);
		$view = $extensionviews[$category->extension];
		
		if ($id < 1)
		{
			$link = '';
		}
		else
		{
			//Create the link
			$link = 'index.php?option=com_nemateria&view='.$view.'&collection='.$category->slug;
			
			$needles = array(
					$view => array($id),
					'category' => array($id)
			);
	
			if ($language && $language != "*" && JLanguageMultilang::isEnabled())
			{
				$db		= JFactory::getDbo();
				$query	= $db->getQuery(true)
				->select('a.sef AS sef')
				->select('a.lang_code AS lang_code')
				->from('#__languages AS a');
	
				$db->setQuery($query);
				$langs = $db->loadObjectList();
				foreach ($langs as $lang)
				{
					if ($language == $lang->lang_code)
					{
						$link .= '&lang='.$lang->sef;
						$needles['language'] = $language;
					}
				}
			}
	
			if ($item = self::_findItem($needles,'category'))
			{

				$link .= '&Itemid='.$item;				
			}
			else
			{
				if ($category)
				{
					$id_collections = array_reverse($category->getPath());
					$needles = array(
							'category' => $id_collections
					);
					if ($item = self::_findItem($needles,'category'))
					{
						$link .= '&Itemid='.$item;
					}
					elseif ($item = self::_findItem(null, 'category'))
					{
						$link .= '&Itemid='.$item;
					}
				}
			}
		}
		
		return $link;
	}	
	
	protected static function _findItem($needles = null, $identifier = 'id')
	{
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu('site');
		
		$language	= isset($needles['language']) ? $needles['language'] : '*';

		// Prepare the reverse lookup array.
		if (!isset(self::$lookup[$language]))
		{
			self::$lookup[$language] = array();

			$component	= JComponentHelper::getComponent('com_exlineo');

			$attributes = array('component_id');
			$values = array($component->id);

			if ($language != '*')
			{
				$attributes[] = 'language';
				$values[] = array($needles['language'], '*');
			}

			$items = $menus->getItems($attributes, $values);
			
			foreach ($items as $item)
			{
				if (isset($item->query) && isset($item->query['view']))
				{
					$view = $item->query['view'];
					if (!isset(self::$lookup[$language][$view]))
					{
						self::$lookup[$language][$view] = array();
					}
					if (isset($item->query[$identifier]))
					{

						// here it will become a bit tricky
						// language != * can override existing entries
						// language == * cannot override existing entries
						if (!isset(self::$lookup[$language][$view][$item->query[$identifier]]) || $item->language != '*')
						{
							if($item->query[$identifier] != 'all') {
								self::$lookup[$language][$view][$item->query[$identifier]] = $item->id;
							}
						}
					}
				}
			}
		}
		
		
		if ($needles)
		{
			foreach ($needles as $view => $ids)
			{
				if (isset(self::$lookup[$language][$view]))
				{
					foreach ($ids as $id)
					{
						if (isset(self::$lookup[$language][$view][(int) $id]))
						{
							if ($id != 'all') {
								return self::$lookup[$language][$view][(int) $id];
							}
						}
					}
				}
			}
		}

		$active = $menus->getActive();
		if ($active && ($active->language == '*' || !JLanguageMultilang::isEnabled()))
		{
			return $active->id;
		}

		// if not found, return language specific home link
		$default = $menus->getDefault($language);
		return !empty($default->id) ? $default->id : null;
	}
}
