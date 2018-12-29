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
 * Controller de l'import de notices de l21oai
 *
 * @package		L21_OAI25
 * @subpackage	com_l21oai
 */

// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

//class L21oai25ControllerImport extends L21oai25Controller
class NemateriaControllerImport extends JControllerAdmin
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
                $notice = $this->getModel('notice');//On récupère le modèle des notices
                $import = $this->getModel('import');//On récupère le modèle de l'importation
                
//                $conf = $configuration->getConfig();//fichier de config
//                $c = $conf->name;
                $post = JRequest::get( 'post' );
                $p = $post['q'];
                $input_start = null;
                $input_end = null;
                $input_force = FALSE;
                $t = null;
                if(isset($post['start'])){
                    $input_start = $post['start'];//
                }
                if(isset($post['end'])){
                    $input_end = $post['end'];//
                }
                if(isset($post['force'])){
                    $input_force = TRUE;//
                }
                if(isset($post['t'])){
                    $t = $post['t'];//resumptionToken
                }
//                $results = &$import->_getImport($c, $p, $input_start, $input_end, $t);//On accède à la méthode permettant d'importer le xml
                $results = $import->_getImport($p, $input_start, $input_end, $t);//On accède à la méthode permettant d'importer le xml
//                var_dump($results);
//                var_dump($input_force);
                $messages = $notice->incrementalEntrepots($results, $input_force);//On appelle la méthode d'enregistrement multiple
                echo($messages);
//                
            JFactory::getApplication()->close(); 
        }
}