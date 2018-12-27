<?php
/**
* @version		$Id$ $Revision$ $Date$ $Author$ $
* @package		Exlineo
* @subpackage 	Views
* @copyright	Copyright (C) 2014, . All rights reserved.
* @license #
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

 
class NemateriaViewNotice  extends JViewLegacy
{

	protected $state = null;
	protected $item = null;
	protected $pagination = null;
	
	public function display($tpl = null)
	{
		$app = JFactory::getApplication();
		$params		= $app->getParams();
		
		$state 		= $this->get('State');
		$item 		= $this->get('Items');
		$pagination	= $this->get('Pagination');
		
		// Prepare the data.
		// Compute the weblink slug & link url.
		for ($i = 0, $n = count($item); $i < $n; $i++)
		{
			$item		= &$item[$i];
							$item->slug	= $item->alias ? ($item->id_notice.':'.$item->alias) : $item->id_collection;
		}
		
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}

		$this->state      = &$state;
		$this->item       = &$item;
		$this->params     = &$params;
		$this->pagination = &$pagination;

		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));		
		
		$this->_prepareDocument();

		// Chargement de JQuery en premier pour éviter les erreurs
		JHtml::_('jquery.framework');
		// Ajout de scripts communs
		$document = JFactory::getDocument();
		$document->addScript('media/com_nemateria/js/nemateria.js');
		$document->addStyleSheet('media/com_nemateria/css/nemateria.css');
		
		// Charger le Helper avec les fonctions de manipulation des données
		JLoader::register('NemateriaHelperUtils', JPATH_COMPONENT . '/helpers/nemateria.utils.php');
		
		// Identifier le format du média
		$tpl = NemateriaHelperUtils::types($item->format);
        
		parent::display($tpl);
	}
	
/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu();
		$pathway	= $app->getPathway();
		$title 		= null;
		
		// Because the application sets a default page title,
		// we need to get it from the menu item itself
		$menu = $menus->getActive();
		
		if ($menu)
		{
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		}
		else
		{
			$this->params->def('page_heading', JText::_('COM_NEMATERIA_DEFAULT_PAGE_TITLE'));
		}


		$title = $this->params->get('page_title', '');

		if (empty($title))
		{
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1)
		{
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2)
		{
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}

		$this->document->setTitle($title);

		if ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}
		
	}	
}
?>