<?php
	// no direct access
	defined('_JEXEC') or die('Restricted access');
	
	$document = JFactory::getDocument();
	
	$document->addStyleSheet('components/com_nemateria/assets/css/recherche.css');
	$document->addScript('components/com_nemateria/assets/lib/jwplayer.js');
	$document->addScript('http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
	
	$document->addScript('components/com_nemateria/assets/lib/interactions.js');
	$document->addScript('components/com_nemateria/assets/lib/infos.js');
	
	require_once(JPATH_ROOT.DS.'components/com_nemateria/assets/lib/actions.php');
			
	// Créer les variables depuis les champs
	$vars = set_variables($this->item->champs);

	// RECUPERER LE LIEN DE LA VIDEO
	$liens = identifiant_lien($this->item->identifier);
	$lien = $liens[1];
	$retour_lien = "http://www.immaterielles.org/index.php/liste-inedites/collection-".(array_slice(explode("/", $lien, -5), -1)[0]);

?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
<h2><?php echo $this->params->get('page_title');  ?></h2>
</div>
<h3><?php echo $this->item->title; ?></h3>

<!--<form method="get" action="<?php // echo $retour_lien; ?>" class="retour_collections">
	<input type="hidden" name="liste_series" value="<?php // echo $vars['isPartOf']; ?>"></input>
	<input type="submit" id="retour" class="bouton retour" value="Retour aux notices"></submit>
</form>-->

<div class="contentpane">
    <div id="ressource">
		
	<a class="bouton" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour aux notices</a>

        <div id="zoneimage" class="box">
        <img src="<?php echo $lien; ?>"/>
        </div>
     
         <div id="infos" class="box moitier">
             <div class="titre">
                <h4>Informations</h4>
             </div>
              <div class="infos">
                 <?php include_once(JPATH_ROOT.DS.'components/com_nemateria/assets/lib/valeurs_bdd.php'); ?>
              </div>
        </div>
        <div id="resume" class="box moitier">
        	<div class="titre">
                <h4>Résumé</h4>
             </div>
             <div class="infos">
				<?php echo $this->item->description; ?>
             </div>
        </div>
     </div>
</div>
<?php
	if (!empty($this->item->pagination) AND $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
	{
	 // echo "Naviguer entre les articles ".$this->pagination;
	 echo $this->pagination->getListFooter();
	}

 ?>