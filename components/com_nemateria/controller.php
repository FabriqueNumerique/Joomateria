<?php
/**
* @version		$Id:controller.php  1 2014-06-03 15:15:53Z exlineo $
* @package		Exlineo
* @subpackage 	Controllers
* @copyright	Copyright (C) 2014, exlineo. All rights reserved.
* @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

/**
 * Exlineo Controller
 *
 * @package    
 * @subpackage Controllers
 */
class NemateriaController extends JControllerLegacy
{


	public function display($cachable = false, $urlparams = false)
	{
		$cachable	= true;	
					if(version_compare(JVERSION,'3','<')) {
				$vName = JRequest::getVar('view', 'contients');			
				JRequest::setVar('view', $vName);
			} else {
				$vName = $this->input->get('view', 'contients');
				$this->input->set('view', $vName);
			}	
			$safeurlparams = array(
			'id'				=> 'INT',
			
		);
		 
		return parent::display($cachable, $safeurlparams);
	}	
	

}// class
?>