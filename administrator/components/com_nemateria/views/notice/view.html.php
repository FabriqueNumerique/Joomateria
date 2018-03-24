<?php

/**
 * @version		$Id: view.html.php 42 2011-03-31 09:12:23Z chdemko $
 * @package		nemateria
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
 * Set View of Nemateria component
 */
class NemateriaViewNotice extends JViewLegacy
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
        jimport('joomla.filesystem.file');


        $document = JFactory::getDocument();
        /**JHTML::script('jquery-1.6.js', 'administrator/components/com_nemateria/assets/scripts/');
        JHTML::script('swfobject.js', 'administrator/components/com_nemateria/assets/scripts/');
        JHTML::script('jquery.uploadify.v2.1.4.js', 'administrator/components/com_nemateria/assets/scripts/');
        JHTML::script('import_doc.js', 'administrator/components/com_nemateria/assets/scripts/');
        JHTML::stylesheet('uploadify.css', 'administrator/components/com_nemateria/assets/css/');
        $document->addCustomTag( '<script type="text/javascript">jQuery.noConflict();</script>' );**/

        // Initialiase variables.
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->state = $this->get('State');

        //Préparation des répertoires de stockage des documents relatifs aux notices.
        /**if(!JFolder::exists(JPATH_SITE.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'nemateria'.DIRECTORY_SEPARATOR.'medias'.DIRECTORY_SEPARATOR.$this->item->id_notice))
        {
            JFolder::create(JPATH_SITE.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'nemateria'.DIRECTORY_SEPARATOR.'medias'.DIRECTORY_SEPARATOR.$this->item->id_notice);
        }**/

//            var_dump($this->item);
//
//            JFactory::getApplication()->close();

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

        $isNew = ($this->item->id_notice == 0);
        JToolBarHelper::title(JText::_('COM_NEMATERIA_NOTICE_MANAGER_' . ($isNew ? 'NEW' : 'EDIT')),'notice_manager');
        // Built the actions for new and existing records.

        JToolBarHelper::apply('notice.apply', 'JTOOLBAR_APPLY');
        JToolBarHelper::save('notice.save', 'JTOOLBAR_SAVE');
        JToolBarHelper::cancel('notice.cancel', 'JTOOLBAR_CANCEL');

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
