<?php

/**

 * @version		

 * @package		

 * @subpackage	

 * @copyright	

 * @license		

 */



defined('_JEXEC') or die;



// On register la classe d'import.

//JLoader::register('ImportRecord', JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'import'.DS.'import.php');



/**

 * Controller de l'import de collections de l21oai

 *

 * @package		L21_OAI25

 * @subpackage	com_l21oai

 */



// import Joomla controlleradmin library

jimport('joomla.application.component.controlleradmin');



//class L21oai25ControllerImport extends L21oai25Controller

class NemateriaControllerImport_set extends JControllerAdmin

{

    /**

	 * Methode de lancement de l'import.

	 *

	 * @return	void

	 */



	public function start()

	{

		// On empeche le navigateur de mettre cette page en cache.

		header('Pragma: no-cache');

		header('Cache-Control: no-cache');

		header('Expires: -1');

                

                set_time_limit(0);//On ne limite pas le temps d'éxécution



		// On vérifie la validitée du token envoyé par la vue précédente.

		//JRequest::checkToken('request') or $this->sendResponse(new JException(JText::_('JX_INVALID_TOKEN'), 403));



		// On va gérer le flux de donnée manuellement.

		ob_start();

//                $configuration = $this->getModel('configuration');

                $import = $this->getModel('import_set');//On récupère le modèle de l'importation

                $set = $this->getModel('set');//On récupère le modèle de l'importation

//                $conf = $configuration->getConfig();//fichier de config

//                $c = $conf->name;

                $p = JRequest::getCmd( 'q' );             

//                $results = &$import->_getImport($c, $p, $input_start, $input_end, $t);//On accède à la méthode permettant d'importer le xml

                $results = $import->getImport($p);//On accède à la méthode permettant d'importer le xml

//                var_dump($results);

//                var_dump($input_force);

                

                $messages = $set->incrementalStores($results);//On appelle la méthode d'enregistrement multiple

                echo($messages);

                JFactory::getApplication()->close();    

            

        }

}