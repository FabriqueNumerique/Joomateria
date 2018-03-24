<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');


class NemateriaControllerEntrepots extends JControllerLegacy
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
    public function getModel($name = 'Entrepot', $prefix = 'NemateriaModel', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $options);
    }
}
?>