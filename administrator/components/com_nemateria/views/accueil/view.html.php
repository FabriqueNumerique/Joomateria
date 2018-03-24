<?php

/**
 * @version		$Id: l21oai.php 9 2012-02-14  labxxi $
 * @package		L21OAI v2.5
 * @subpackage	Component
 * @copyright	Copyright (C) 2010-today Labxxi. All rights reserved.
 * @author		Labxxi
 * @link		http://labxxi.com
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Entries View of nemateria component
 */
class NemateriaViewAccueil extends JViewLegacy
{
    /**
     * Execute and display a layout script.
     *
     * @param	string $tpl	The name of the layout file to parse.
     *
     * @return 	void|JError
     *
     * @see		JViewLegacy::display
     */
    public function display($tpl = null)
    {

        $states = $this->get('States');
        $this->states = $states;
        $entrepots = $this->get('Entrepots');
        $this->entrepots  = $entrepots;

        $collections = $this->get('Collections');
        $this->collections = $collections;

        $notices = $this->get('Notices');
        $this->notices = $notices;

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
        $doc = JFactory::getDocument();
        //Ajout d'une feuille de style
        $doc->addStyleSheet('components/com_nemateria/assets/css/style.css');
        JToolBarHelper::title( '', 'l21.png' );
        nemateriaHelper::addSubmenu(JRequest::getCmd('view', 'accueil'));
        //Acces aux options du composant
        JToolBarHelper::preferences( 'com_nemateria', 600, 900 );
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