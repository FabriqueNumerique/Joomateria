<?php

/**
 * @version		$Id: view.html.php 42 2011-03-31 09:12:23Z chdemko $
 * @package		l21oai25
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
 * Entry View of l21oai25 component
 */
class NemateriaViewEntrepot extends JViewLegacy
{
	/**
	 * Execute and display a layout script.
	 *
	 * @param	string $tpl	The name of the layout file to parse.
	 *
	 * @return	void|JError
	 *
	 * @see		JView::display
	 */
	public function display($tpl = null) 
	{
		// Initialiase variables.
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		$this->state = $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode("<br />", $errors));
			return false;
		}

		// Add toolbar
		$this->addToolbar();

		// Prepare the document
		$this->prepareDocument();

		// Display the layout
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 */
	protected function addToolbar() 
	{
                $doc = JFactory::getDocument();
                //Ajout d'une feuille de style
                $doc->addStyleSheet('components/com_nemateria/assets/css/style.css');
                JHTML::script('jquery-1.6.js', 'administrator/components/com_nemateria/assets/scripts/');
                JHTML::script('infostore.js', 'administrator/components/com_nemateria/assets/scripts/');
		$isNew = ($this->item->id_entrepot == 0);
                JToolBarHelper::title(JText::_('COM_NEMATERIA_ENTREPOT_' . ($isNew ? 'NEW' : 'EDIT')),'entrepot_manager');
                // Built the actions for new and existing records.
		
                JToolBarHelper::apply('entrepot.apply', 'JTOOLBAR_APPLY');
                JToolBarHelper::save('entrepot.save', 'JTOOLBAR_SAVE');
                JToolBarHelper::cancel('entrepot.cancel', 'JTOOLBAR_CANCEL');

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
