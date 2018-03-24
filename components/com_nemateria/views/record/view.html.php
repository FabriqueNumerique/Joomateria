<?php
/**
* @version		$Id$ $Revision$ $Date$ $Author$ $
* @package		Exlineo
* @subpackage 	Views
* @copyright	Copyright (C) 2014, exlineo. All rights reserved.
* @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
require_once(JPATH_ROOT.DS.'components/com_nemateria/assets/lib/actions.php');

jimport('joomla.application.component.view');

 
class NemateriaViewNotice  extends JViewLegacy
{

	protected $form;

	protected $item;

	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{

		$app = JFactory::getApplication('site');
		
		$document = JFactory::getDocument();
		$document->addStyleSheet('components/com_nemateria/assets/css/recherche.css');
		
		// Initialise variables.		
		$this->item  = $this->get('Item');
		$this->state = $this->get('State');
		// $this->items = $this->get('Items');
		$this->item->pagination = $this->get('Pagination');
		
		$tmpl = $this->item->format;
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseWarning(500, implode("\n", $errors));

			return false;
		}
		
		//Get Params and Merge
		$this->params	= $this->state->get('params');
		$active	= $app->getMenu()->getActive();
		$temp	= clone ($this->params);
		$temp->merge($this->item->params);
		$this->item->params = $temp;
		
		// parent::display($tpl);
		// echo gere_type($tmpl);
		parent::display(gere_type($tmpl));
	}
}
?> 