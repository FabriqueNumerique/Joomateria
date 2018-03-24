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
 * Sets Controller of L21oai25 component
 */
class NemateriaControllerCollections extends JControllerAdmin
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
    public function getModel($name = 'Collection', $prefix = 'NemateriaModel', $config = array('ignore_request' => true))
    {
        //return parent::getModel($name, $prefix, $options);
        return parent::getModel($name, $prefix, $config);
    }

    /**
     * Method to remove a set.
     *
     * @return	void
     * @since	1.6
     */
    public function delete()
    {
        // Check for request forgeries.
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        // Get the model.
        $collections = $this->getModel('collections');

//                $records->delete();
//                JFactory::getApplication()->close();

        // Load the filter state.
        $app = JFactory::getApplication();

//		$type = $app->getUserState($this->context.'.filter.type');
//		$model->setState('filter.type', $type);
//
//		$begin = $app->getUserState($this->context.'.filter.begin');
//		$model->setState('filter.begin', $begin);
//
//		$end = $app->getUserState($this->context.'.filter.end');
//		$model->setState('filter.end', $end);
//
//		$categoryId = $app->getUserState($this->context.'.filter.category_id');
//		$model->setState('filter.category_id', $categoryId);
//
//		$clientId = $app->getUserState($this->context.'.filter.client_id');
//		$model->setState('filter.client_id', $clientId);
//
//		$model->setState('list.limit', 0);
//		$model->setState('list.start', 0);
//
//		$count = $model->getTotal();
        // Remove the items.
//                $model->delete();
        if (!$collections->delete()) {
            JError::raiseWarning(500, $collections->getError());
        } else {
            $this->setMessage(JText::plural('COM_NEMATERIA_N_ITEMS_DELETED', $count));
        }

        $this->setRedirect('index.php?option=com_nemateria&view=notices');
    }
}