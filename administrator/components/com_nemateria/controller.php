<?php
defined('_JEXEC') or die;

class NemateriaController extends JControllerLegacy
{
    public function display($cachable = false, $urlparams = false)
    {
        $document = JFactory::getDocument();
        
        //La vue par défaut est accueil
        $vName = $this->input->get('view', 'accueil');
        $this->input->set('view', $vName);

        $safeurlparams = array(
            'id'=>'INT',
        );

        parent::display($cachable, $safeurlparams);

        return $this;
    }
}