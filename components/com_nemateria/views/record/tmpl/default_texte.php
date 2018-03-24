<?php
	// no direct access
	defined('_JEXEC') or die('Restricted access');
	$document = JFactory::getDocument();
	
	$document->addStyleSheet('components/com_nemateria/assets/css/recherche.css');
	$document->addScript('components/com_nemateria/assets/lib/jwplayer.js');
	$document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
	
	$document->addScript('components/com_nemateria/assets/lib/interactions.js');
	
	require_once(JPATH_ROOT.DS.'components/com_nemateria/assets/lib/actions.php');
	
	$document->addScript('components/com_nemateria/assets/lib/infos.js');
			
	// Créer les variables depuis les champs
	$vars = set_variables($this->item->champs);
	
	// RECUPERER LES SEQUENCES
	$sequences = get_tableau($this->item->champs);
	
	// RECUPERER LE LIEN DE LA VIDEO
	$liens = identifiant_lien($this->item->identifier);
	
	// foreach (JRequest::get( 'get' ) as $c => $v){
	foreach ($_GET as $c => $v){
		// echo $c." > ".$v.'<br/>';
	}

	$page=JRequest::getVar('page');
	// echo "Page = ".$page." > ".$_SERVER['PHP_SELF'];
	// echo $_SERVER['QUERY_STRING'].'<br />';
	// echo JUri::current();
?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>"><h2><?php echo $this->params->get('page_title');  ?></h2></div>
	<a class="bouton" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour aux notices</a>
<h3><?php echo $this->item->title; ?></h3>

<div class="contentpane">

<?php // $type = gere_type('image'); ?>
		<div id="ressource">
            <!-- INSERER UN TEXTE -->
            <div id="zonetexte" class="box">
				<script type="text/javascript">affichePDF("<?php echo $liens[1]; ?>");</script>
                <!--<object data="<?php // echo $liens[1]; ?>" type="application/pdf">
         
                  <p>Il semble que vous n'ayez pas de plugin de lecture de PDF, merci de télécharger le fichier en cliquant sur ce lient <a href="https://acrobat.adobe.com/fr/fr/acrobat/pdf-reader.html">TELECHARGER LE FICHIER</a></p>
                  
                </object>-->
                <?php
				  // Ajouter les pictos s'il y a des documents liés
					include("components/com_nemateria/assets/lib/documents_lies.php");
				?>
            </div>
         </div>
     <?php include_once(JPATH_ROOT.DS.'components/com_nemateria/assets/lib/onglets_texte.php'); ?>
</div>
 