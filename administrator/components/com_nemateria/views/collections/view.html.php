<?php

/**
 * @version		$Id: view.html.php 42 2011-03-31 09:12:23Z chdemko $
 * @package		L21oai25
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
 * Entries View of L21oai25 component
 */
class NemateriaViewCollections extends JViewLegacy
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
        $this->items = $items;
        $this->pagination = $pagination;
        $this->state = $state;

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
		
        JToolBarHelper::addNew('collection.add', 'JTOOLBAR_NEW');
        JToolBarHelper::title( JText::_( 'COM_NEMATERIA_SUBMENU_COLLECTION_ALT' ), 'collection_manager.png' );
        JToolBarHelper::editList('collection.edit', 'JTOOLBAR_EDIT');
        JToolBarHelper::deleteList(JText::_('COM_NEMATERIA_COLLECTION_DEL'),'collections.delete');
		
        //Nouvelle action : récupérer les sets associés à l'entrepôt
        $toolbar = JToolBar::getInstance('toolbar');
        //JToolBarHelper::custom( 'import', 'l21oai_set', 'l21oai_set', 'Importer les notices', true, true );
        $toolbar->appendButton('Popup', 'nemateria_collection', 'COM_NEMATERIA_SUBMENU_NOTICE_IMPORT', 'index.php?option=com_nemateria&view=import&tmpl=component', 1024, 680);
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
