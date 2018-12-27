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

// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

/**
 * Store Controller of L21oai25 component
 */
class NemateriaControllerAccueil extends JControllerAdmin
{
	/**
	 * Method to get a model object, loading it if required.
	 *
	 * @param	string	$name	The model name. Optional.
	 * @param	string	$prefix	The class prefix. Optional.
	 * @param	array	$config	Configuration array for model. Optional.
	 *
	 * @return	object	The model.
	 *
	 * @note Overload JControllerForm::getModel
	 */
	
	public function getModel($name = 'Accueil', $prefix = 'nemateriaModel', $config = array('ignore_request' => true))
	{
        echo " / Accueil activé";
		return parent::getModel($name, $prefix, $options);
	}
}
