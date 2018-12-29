<?php
/**
 * @version		
 * @package		
 * @subpackage	
 * @copyright	
 * @license		
 */

defined('_JEXEC') or die;


/**
 * Controller de l'import de miniature des notices de l21oai
 *
 * @package     L21_OAI
 * @subpackage	com_l21oai
 */

// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

class NemateriaControllerImport_img extends JControllerAdmin
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
                $import_img = $this->getModel('import_img');//On récupère le modèle de l'importation
                
                $post = JRequest::get( 'post' );
                $limit_start = 0;
                if(isset($post['q'])){
                    $limit_start = $post['q'];//la limite basse des id pour la requête
                }
               
                $messages = &$import_img->getDocuments($limit_start);//On appelle la méthode d'enregistrement multiple
                echo($messages);
//                
            JFactory::getApplication()->close(); 
        }
}