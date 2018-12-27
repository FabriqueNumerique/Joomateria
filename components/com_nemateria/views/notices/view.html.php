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

 
class NemateriaViewNotices  extends JViewLegacy
{

	protected $state = null;
	protected $items = null;
	protected $pagination = null;
    protected $series = null;
	
	public function display($tpl = null)
	{
		
		$app = JFactory::getApplication();
		$params		= $app->getParams();
		
		$state 		= $this->get('State');
		$items 		= $this->get('Items');
		$pagination	= $this->get('Pagination');
        $series     = $this->get('Series');

		// Prepare the data.
		// Compute the weblink slug & link url.
		for ($i = 0, $n = count($items); $i < $n; $i++)
		{
			$item		= &$items[$i];
							$item->slug	= $item->alias ? ($item->id_collection.':'.$item->alias) : $item->id_collection;
		}
		
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}

		$this->state      = &$state;
		$this->items      = &$items;
		$this->params     = &$params;
		$this->pagination = &$pagination;
        $this->series     = &$series;
        
		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));		
		
		$this->_prepareDocument();
		
		// Orientation vers le template identifié dans le menu : option Type
		if(isset($this->type_collection)){
			if(isset($this->gabarit)){
				$tpl = $this->type_collection."_".$this->gabarit;
			}else{
				$tpl = $this->type_collection;
			}
		}
		// Chargement de JQuery en premier pour éviter les erreurs
		JHtml::_('jquery.framework');
		// Ajout de scripts communs
		$document = JFactory::getDocument();
		$document->addScript('media/com_nemateria/js/nemateria.js');
		$document->addStyleSheet('media/com_nemateria/css/nemateria.css');
		
		// Charger le Helper avec les fonctions de manipulation des données
		JLoader::register('NemateriaHelperUtils', JPATH_COMPONENT . '/helpers/nemateria.utils.php');
		
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
		// EXLINEO - Gestion des champs 'Collection' (lid_collection) et du type de collection pour l'affichage (tpl)
		$this->ids_collection = $menu->query['id_collection'];
		$this->type_collection = $menu->query['type'];
		if(isset($menu->query['gabarit'])){
			$this->gabarit = $menu->query['gabarit'];
		}
		
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