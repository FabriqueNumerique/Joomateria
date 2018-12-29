<?php

/**
 * @version		$Id: nemateria.php 01-01--2018 exlineo
 * @package		NEMATERIA v0.8
 * @subpackage	Component
 * @copyright	Copyright (C) 2010-today Labxxi. All rights reserved.
 * @author		exlineo
 * @link		http://www.exlineo.com
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
