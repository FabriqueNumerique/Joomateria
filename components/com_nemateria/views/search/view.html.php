<?php
/**
 * @version		$Id: view.html.php 10 23-05-2013 LABXXI $
 * @package		com_exlineo
 * @subpackage          FrontOffice
 * @copyright           Copyright (C) 2010 - today LABXXI, Inc. All rights reserved.
 * @author		Mathieu Roulland
 * @link		http://www.exlineo.com
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

jimport( 'joomla.html.parameter' );

/**
 * l21oaiViewsearch : Controlleur de la vue des recherches
 *
 * @package		com_l21oai
 * @subpackage          FrontOffice
 * 
 * @author		Mathieu Roulland
 */
class NemateriaViewRecherche extends JViewLegacy
{
    /**
    * Method to display the view.
    *
    * @access public
    * 
    * @param string $tpl	
    */
    function display($tpl = null)
    {
            global $app;

            require_once(JPATH_COMPONENT_ADMINISTRATOR.'/helpers/search.php' );

            // Initialize some variables
            $app = JFactory::getApplication();
            $pathway = $app->getPathway();
            $uri      =& JFactory::getURI();

            $error	= null;
            $rows	= null;
            $results    = null;
            $total	= 0;

            // Get some data from the model
            $areas      = $this->get('areas');
            $state 	= $this->get('state');
            $searchword = $state->get('keyword');
            $params = $app->getParams();

            $menus	= $app->getMenu();
            $menu	= $menus->getActive();

            // because the application sets a default page title, we need to get it
            // right from the menu item itself
            if (is_object($menu)) {
			$menu_params = new JRegistry;
			$menu_params->loadString($menu->params);
			if (!$menu_params->get('page_title')) {
				$params->set('page_title',	JText::_('COM_NEMATERIA_SEARCH'));
			}
		}
		else {
			$params->set('page_title',	JText::_('COM_NEMATERIA_SEARCH'));
		}
            $title = $params->get('page_title');
            if ($app->getCfg('sitename_pagetitles', 0) == 1) {
                    $title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
            }
            elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
                    $title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
            }
            $this->document->setTitle($title);
            

            // built select lists
            $orders = array();
            $orders[] = JHtml::_('select.option',  'alpha', JText::_('COM_NEMATERIA_ALPHABETICAL'));
            $orders[] = JHtml::_('select.option',  'newest', JText::_('COM_NEMATERIA_NEWEST_FIRST'));
            $orders[] = JHtml::_('select.option',  'oldest', JText::_('COM_NEMATERIA_OLDEST_FIRST'));
            //$orders[] = JHtml::_('select.option',  'popular', JText::_('COM_EXLINEO_MOST_POPULAR'));
            //$orders[] = JHtml::_('select.option',  'category', JText::_('JCATEGORY'));

            $lists = array();
            $lists['ordering'] = JHtml::_('select.genericlist',   $orders, 'ordering', 'class="inputbox"', 'value', 'text', $state->get('ordering') );

            $searchphrases 		= array();
            $searchphrases[]	= JHtml::_('select.option',  'all', JText::_('COM_NEMATERIA_ALL_WORDS'));
            $searchphrases[]	= JHtml::_('select.option',  'exact', JText::_('COM_NEMATERIA_EXACT_PHRASE'));
            //$searchphrases[]	= JHtml::_('select.option',  'any', JText::_('COM_EXLINEO_ANY_WORDS'));
            $lists['searchphrase']= JHtml::_('select.radiolist',  $searchphrases, 'searchphrase', '', 'value', 'text', $state->get('match'));


            $state->set('keyword', $searchword);
            if ($error == null )
            {
                    $results	= $this->get('data' );
                    $total	= $this->get('total');
                    $pagination	= $this->get('pagination');

                    require_once (JPATH_SITE.'/components/com_nemateria/router.php');

            }
            //Ajout de la feuille de style
            JHTML::stylesheet('default.css', 'components/com_nemateria/css/');
                
            $active = JFactory::getApplication()->getMenu()->getActive();
            if (isset($active->query['layout'])) {
                    $this->setLayout($active->query['layout']);
            }

            $this->assignRef('pagination',  $pagination);
            $this->assignRef('results',		$results);
            $this->assignRef('lists',		$lists);
            $this->assignRef('params',		$params);

            $this->ordering = $state->get('ordering');
            $this->searchword = $searchword;
            $this->origkeyword = $state->get('origkeyword');
            $this->searchphrase = $state->get('match');
            $this->searchareas = $areas;

            $this->total = $total;
            $this->error = $error;
            $this->action = $uri;
            
            //Remplissage des paramètres de recherche
			$this->motcle      			= $motcle    		        = urldecode(JRequest::getString('motcle'));
            $this->keywordTitle         = $keywordTitle             = urldecode(JRequest::getString('searchTitle'));
            $this->keywordArtiste       = $keywordArtiste           = urldecode(JRequest::getString('searchArtiste'));
            $this->keywordEditor        = $keywordEditor            = urldecode(JRequest::getString('searchEditor'));
            $this->keywordSubject       = $keywordSubject           = urldecode(JRequest::getString('searchSubject'));
            $this->keywordDescription   = $keywordDescription       = urldecode(JRequest::getString('searchDescription'));
            
            $this->keywordSearchdate    = $validSearchDate          = JRequest::getVar('validSearchDate');
            
            if(JRequest::getVar('minDate') != "" && JRequest::getVar('maxDate') != ""){
                $this->keywordFrom          = $anneeFrom                = urldecode(JRequest::getInt('minDate'));
                $this->keywordUntil         = $anneeUntil               = urldecode(JRequest::getInt('maxDate'));
            }
            else{// @ToDo A corriger / simplifier la détection des temps
                $this->keywordFrom          = false;
                $this->keywordUntil         = false;
            }
            
            $this->keywordAreasT        = $areasT                   = JRequest::getVar('areasT');
            $this->keywordAreasF        = $areasF                   = JRequest::getVar('areasF');
            
            
            //Script
            JHTML::script('http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js');
            JHTML::script('enabledate.js', 'components/com_nematereia/js/');

            parent::display($tpl);
    }
}
