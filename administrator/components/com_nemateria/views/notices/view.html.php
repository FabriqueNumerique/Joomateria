<?php

/**
 * @version		$Id: view.html.php 42 2011-03-31 09:12:23Z chdemko $
 * @package		Nemateria
 * @subpackage	Component
 * @copyright	Copyright (C) 2010-today Christophe Demko. All rights reserved.
 * @author		Christophe Demko
 * @link		http://joomlacode.org/gf/project/l21oai25/
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Entries View of Nemateria component
 */
class NemateriaViewNotices extends JViewLegacy
{
	/**
	 * Execute and display a layout script.
	 *
	 * @param	string $tpl	The name of the layout file to parse.
	 *
	 * @return 	void|JError
	 *
	 * @see		JView::display
	 */
	public function display($tpl = null) 
	{
		$mainframe = JFactory::getApplication();

        $context='com_nemateria.notices.list.';
        $layout=JRequest::getCmd('layout','');
        
        $filter_collection=$mainframe->getUserStateFromRequest($context.'filter_collection','filter_collection','','int');
        
        //$search=$mainframe->getUserStateFromRequest($context.'search','search','','string');
        //$search=JString::strtolower($search);
		
		$collection[]=JHTML::_('select.option','','- '.JText::_('Sélectionner une collection').' -');
        $collections=$this->get('AllCollections');
		for($i=0;$i<count($collections);$i++)
            $collection[]=JHTML::_('select.option',$collections[$i]->id_collection,$collections[$i]->spec);
			
		$lists['collection']=JHTML::_('select.genericlist',$collection,'filter_collection','class="inputbox" size="1" on-change="submitform( );"','value','text',$filter_collection);
		
            // Get data from the model
	    $items = $this->get('Items');
        $pagination = $this->get('Pagination');
	    $state = $this->get('State');
            
            // Check for errors.
            if (count($errors = $this->get('Errors'))) 
            {
                    JError::raiseError(500, implode('<br />', $errors));
                    return false;
            }
            
            // Assign data to the view
			//$lists['search']=$search;
			
            $this->items = $items;
            $this->pagination = $pagination;
            $this->state = $state;
			$this->lists = $lists;
            
            // Set the toolbar
            $this->addToolBar();

            // Prepare the document
            $this->prepareDocument();
		
            parent::display($tpl);
	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar() 
	{
               NemateriaHelper::addSubmenu(JRequest::getCmd('view', 'accueil'));
               $doc = JFactory::getDocument();
                //Ajout d'une feuille de style
                $doc->addStyleSheet('components/com_nemateria/assets/css/style.css');
		        JToolBarHelper::title( JText::_( 'COM_NEMATERIA_METADATA_MANAGER' ), 'metadata_manager.png' );
                JToolBarHelper::deleteList(JText::_('COM_NEMATERIA_NOTICE_DEL'),'notices.delete');
                JToolBarHelper::editList('notice.edit', 'JTOOLBAR_EDIT');
                JToolBarHelper::addNew('notice.add', 'JTOOLBAR_NEW');
                JToolBarHelper::custom('notices.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
                JToolBarHelper::custom('notices.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
                //Ajout du bouton permettant de récupérer les documents
                $toolbar = JToolBar::getInstance('toolbar');
                //JToolBarHelper::custom( 'import', 'l21oai_set', 'l21oai_set', 'Importer les notices', true, true );
                $toolbar->appendButton('Popup', 'nemateria_collection', 'Import Miniatures', 'index.php?option=com_nemateria&view=import_img&tmpl=component', 800, 400);
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function prepareDocument() 
	{
	}
}
