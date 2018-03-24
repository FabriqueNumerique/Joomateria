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
class NemateriaViewImport_collection extends JViewLegacy
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
            JHTML::script('jquery-1.6.js', 'administrator/components/com_nemateria/assets/scripts/');
            JHTML::script('jquery.ui.core.js', 'administrator/components/com_nemateria/assets/scripts/');
            JHTML::script('jquery.ui.widget.js', 'administrator/components/com_nemateria/assets/scripts/');
            JHTML::script('jquery.ui.datepicker.js', 'administrator/components/com_nemateria/assets/scripts/');
            JHTML::script('jquery.ui.datepicker-fr.js', 'administrator/components/com_nemateria/assets/scripts/');
            JHTML::script('import_set.js', 'administrator/components/com_nemateria/assets/scripts/');
            JHTML::stylesheet('import.css', 'administrator/components/com_nemateria/assets/css/');
            JHTML::stylesheet('jquery.ui.datepicker.css', 'administrator/components/com_nemateria/assets/css/');
            $document->addCustomTag( '<script type="text/javascript">jQuery.noConflict();</script>' );


            parent::display();
	}
}