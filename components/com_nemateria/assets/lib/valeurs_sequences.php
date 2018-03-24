<?php
    require_once(JPATH_ROOT.DS.'components/com_exlineo/assets/lib/actions.php');
			
	// Créer les variables depuis les champs
	$vars = set_variables($item->champs);
	echo $vars;
?>