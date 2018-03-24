<?php
defined('_JEXEC') or die;

// verification du droit d'acces
if (!JFactory::getUser()->authorise('core.manage', 'com_nemateria'))
{
    return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// appel du fichier helpers
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helpers.php';

// import de la bibliothèque controller de Joomla
jimport('joomla.application.component.controller');

// recuperation d'une instance du controller prefixé par nemateria
$controller = JControllerAdmin::getInstance('nemateria');

// execution de la requete task
$controller->execute(JFactory::getApplication()->input->get('task'));

// redirection si prévu dans le controller
$controller->redirect();