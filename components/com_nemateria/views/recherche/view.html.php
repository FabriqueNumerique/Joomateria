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

 
class NemateriaViewRecherche  extends JViewLegacy
{

	protected $state = null;

	protected $items = null;

	protected $pagination = null;
	
	public function display($tpl = null)
	{
		$document = JFactory::getDocument();
		$document->addStyleSheet('components/com_nemateria/assets/css/recherche.css');
		// $document->addScript($url);
		
		$app = JFactory::getApplication();
		$params		= $app->getParams();
		$tmpl = '';
		
		$state 		= $this->get('State');
		$items 		= $this->get('Items');
		$pagination	= $this->get('Pagination');

		// Prepare the data.
		// Compute the weblink slug & link url.
		for ($i = 0, $n = count($items); $i < $n; $i++)
		{
			$item		= &$items[$i];
							$item->slug	= $item->alias ? ($item->id_notice.':'.$item->alias) : $item->id_notice;
			
			// echo "ITEM : ".$item;
			$temp = new JRegistry;
			// $temp->loadString($item->params);
			$item->params = clone($params);
			$item->params->merge($temp);
			$tmpl = $item->format;
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
		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));		
		
		$this->_prepareDocument();
		
		// parent::display($tpl);
		// EXLINEO > CALER LE TYPE DE FICHIER SELECTIONNE, LE SECOND PARAMETRE PERMET DE SAVOIR SI C'EST UNE PAGE MULTIMEDIAS
		parent::display(gere_type($tmpl, JRequest::getVar('m')));
		
		/*echo 'TMPL >'.$tmpl.'Template choisi > '.gere_type($tmpl);*/
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

		$id = (int) @$menu->query['id'];


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