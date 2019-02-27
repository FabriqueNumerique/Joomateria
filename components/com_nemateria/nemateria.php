<?php
/**
 * @version 1
 * @package    joomla
 * @subpackage Exlineo
 * @author	   	exlineo
 *  @copyright  	Copyright (C) 2014, exlineo. All rights reserved.
 *  @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

//--No direct access
defined('_JEXEC') or die('Resrtricted Access');

// require_once JPATH_COMPONENT.'/helpers/route.php';

$controller = JControllerLegacy::getInstance('Nemateria');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();