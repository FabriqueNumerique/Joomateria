<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');


class NemateriaControllerEntrepot extends JControllerForm
{
    public function start()
    {

        $entrepot = $this->getModel('entrepot');//On récupère le modèle des stores

        $conf = JRequest::getCmd( 'config' );
        $url = JRequest::getVar( 'url' ); //// Faille de securité
//                $results = &$import->_getImport($c, $p, $input_start, $input_end, $t);//On accède à la méthode permettant d'importer le xml
        $results=$entrepot->getInfostore($url, $conf);
//                var_dump($results);
//                var_dump($input_force);

        $container = json_encode($results);
        echo $container;
        JFactory::getApplication()->close();
    }
}
?>