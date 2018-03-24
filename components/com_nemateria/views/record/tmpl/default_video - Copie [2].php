<?php
	// no direct access
	defined('_JEXEC') or die('Restricted access');
	
	$document = JFactory::getDocument();
	
	$document->addStyleSheet('components/com_exlineo/assets/css/recherche.css');
	$document->addScript('components/com_exlineo/assets/lib/jwplayer.js');
	$document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
	
	$document->addScript('components/com_exlineo/assets/lib/interactions.js');
	
	require_once(JPATH_ROOT.DS.'components/com_exlineo/assets/lib/actions.php');
	$document->addScript('components/com_exlineo/assets/lib/infos.js');
			
	// Créer les variables depuis les champs
	$vars = set_variables($this->item->champs);
	
	// RECUPERER LES SEQUENCES
	$sequences = get_tableau($this->item->champs);
	
	// RECUPERER LE LIEN DE LA VIDEO
	$liens = identifiant_lien($this->item->identifier);
?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<h2><?php echo $this->params->get('page_title');  ?></h2>
    <a href="#" id="retour_collections" class="bouton">Revenir aux notices</a>
</div>
<h3><?php echo $this->item->title; ?></h3>
<div class="contentpane">
    <div id="ressource">
        <!-- INSERER UNE VIDEO -->
    <div id="zonevideo" class="box moitier">
        <div id='video_exlineo'></div>
			<script type='text/javascript'>
              jwplayer('video_exlineo').setup({
                'flashplayer': '<?php echo(JURI::base());?>components/com_exlineo/assets/player.swf',
                'file': '<?php echo $liens[1]; ?>',
                'controlbar': 'bottom',
				'skin' : '<?php echo(JURI::base());?>components/com_exlineo/assets/unlimblue.zip',
                'width': '540',
                'height': '405'
              });
            </script>
         <?php if(count($sequences['sequence']) > 0): ?>
         	<h4>Séquençage des données</h4>
            <div id='sequences'>
			<?php
                // CREER LES SEQUENCES
                for ($i=0; $i<count($sequences['sequence']);$i++):
            ?>

            <div class='sequence' id='seq<?php echo $i; ?>'>
                <div class='sequencenum'><?php echo $sequences['titre'][$i];?></div>
                <div class='sequencetitre'><a onClick="change_class('seq<?php echo $i; ?>', <?php echo intval($sequences['sequence'][$i]/60000);?>)" title='<?php echo $sequences['descr'][$i];?>'><?php echo $sequences['descr'][$i];?></a></div>
                <div class='sequenceduree'><?php echo (get_temps($sequences['duree'][$i]));?></div>
                <div></div>
            </div>
        <?php endfor; ?>
		<?php endif; ?>
        </div>
     
         <div id="infos" class="box tiers">
             <div class="titre">
                <h4>Informations</h4>
             </div>
              <div class="infos">
                 <?php include_once(JPATH_ROOT.DS.'components/com_exlineo/assets/lib/valeurs_bdd.php'); ?>
              </div>
        </div>
        <div id="resume" class="box" >
        	<div class="titre">
                <h4>Résumé</h4>
             </div>
             <div class="infos">
				<?php echo $this->item->description; ?>
             </div>
        </div>
     </div>
</div>