<?php
/**
 * @version		
 * @package		
 * @subpackage	
 * @copyright	
 * @license		
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * Indexer view class for Finder.
 *
 * @package		
 * @subpackage	
 * @version		
 */
class NemateriaViewImport extends JViewLegacy
{
	/**
	 * Method to display the view.
	 *
	 * @access	
	 * @param	
	 * @return	
	 * @throws	
	 * @since	
	 */
	function display($tpl = null)
	{  
			$document = JFactory::getDocument();
            // $document->addScript( JURI::base().'/components/com_nemateria/assets/scripts/jquery-1.6.js');
            // $document->addScript( JURI::base().'/components/com_nemateria/assets/scripts/jquery.ui.core.js');
        	JHtml::_('jquery.framework');    
			$document->addScript( JURI::base().'/components/com_nemateria/assets/scripts/jquery.ui.widget.js');
            $document->addScript( JURI::base().'/components/com_nemateria/assets/scripts/jquery.ui.datepicker.js');
            $document->addScript( JURI::base().'/components/com_nemateria/assets/scripts/jquery.ui.datepicker-fr.js');
			$document->addScript( JURI::base().'/components/com_nemateria/assets/scripts/import.js');
			$document->addStyleSheet( JURI::base().'/components/com_nemateria/assets/css/jquery.ui.datepicker.css');
            $document->addCustomTag( '<script type="text/javascript">jQuery.noConflict();</script>' );


            parent::display();
	}
}