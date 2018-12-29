<?php
/**
 * Helper class for Nemateria utils
 * 
 * @package    Nemateria
 * @license        GNU/GPL, see LICENSE.php
 * Joomateria is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

define('_JEXEC', 1);
define('JPATH_BASE', realpath(dirname(__FILE__) . '/../../../'));  
require_once JPATH_BASE . '/includes/defines.php';
require_once JPATH_BASE . '/includes/framework.php';
	
// Récupérer les données envoyées
$message = file_get_contents("php://input");
envoieMail(str_replace(",","\n",$message));
// Envoyer un email avec Joomla
function envoieMail($data){
	$mailer = JFactory::getMailer();
	$config = JFactory::getConfig();
	$sender = array( 
		$config->get( 'mailfrom' ),
		$config->get( 'fromname' ) 
	);

	$mailer->setSender($sender);
	$mailer->addRecipient($config->get('mailfrom'));
	$body   = "Une contribution a été envoyée sur une notice de collection :\n$data";
	$mailer->setSubject('Contribution sur une notice de collection');
	$mailer->setBody($body);
	
	$send = $mailer->Send();
	echo "coucou";
	if ( $send !== true ) {
		echo "Erreur dans l'envoie du message";
	} else {
		echo "Votre message a été envoyé, merci pour votre contribution";
	}
}