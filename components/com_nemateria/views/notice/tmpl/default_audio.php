<?php
	// no direct access
	defined('_JEXEC') or die('Restricted access');
    
    $document = JFactory::getDocument();
    $document->addScript('media/com_nemateria/JW7/jwplayer.js');
			
	// TRAITER LES METADONNEES DEPUIS LE CHAMP... CHAMPS
    $metadiverses = NemateriaHelperUtils::set_variables($this->item->champs);

    // RECUPERER LES SEQUENCES
    $liens = NemateriaHelperUtils::identifiant_lien($this->item->identifier);
	
	// RECUPERER LES SEQUENCES > Ajout d'un la durée pour calculer le temps : audio : isReferencedBy, video : references
	$sequences = NemateriaHelperUtils::get_tableau($this->item->champs);

?>
<header class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<a class="bouton" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour aux notices</a>
    <h2><?php echo $this->params->get('page_title');  ?></h2>
    <h3><?php echo $this->item->title; ?></h3>
	
</header>

<section id="notice" class="partage">
    <?php
        // Ajouter les pictos s'il y a des documents liés
        require(JPATH_COMPONENT_SITE . '/views/notice/tmpl/utils/documents_lies.php');
	?>
    <!-- INSERER UNE VIDEO -->
    <article id="zoneaudio">
        <div id='audio_nemateria'>Il semble que vous n'ayez pas le lecteur Flash. <a href="https://get.adobe.com/fr/flashplayer/" target="_blank">Merci de l'installer pour consulter les ressources multimédia de ce site Internet.</a>
        </div>
        
        <script type='text/javascript'>
              jwplayer.key='mdg3Hk8Xq/Q0L0njCmlZaJ8yxm0+RjA+DbF9rg==';
			  jwplayer('audio_nemateria').setup({
				file:'<?php echo $liens[1]; ?>',
				modes: [
					{ type: 'html5' },
					{ type: 'flash', src: '<?php echo(JURI::base());?>media/com_nemateria/JW7/jwplayer.flash.swf' }					
				],
				androidhls:'true',
				skin:{name:'vapor', active:'#FF0000',},
				width:'100%',
				height:30
			  });
			  // Suivre le déroulé de la lecture pour modifier la playliste
			  jwplayer('audio_nemateria').on('time', function(e) { 
				// Lister les séquences et modifier les classes
				change_playliste(Math.floor(e.position));
			  });
        </script>
		
		<?php if(count($sequences['sequence']) > 0): ?>
         	<h4>Résumés des séquences</h4>
            <div id='sequences'>
         <?php
                // CREER LES SEQUENCES
                for ($i=0; $i<count($sequences['sequence']);$i++):
         ?>
            
         <!-- Création des séquences -->
         <?php
                $cache='';
				// Vérifier s'il existe des liens ou des renvois vers des PDF dans la description de la séquence
				if(count($sequences['descr']) > 0){
					if(strrpos($sequences['descr'][$i], "#page") !== false || strrpos($sequences['descr'][$i], "http") !== false){
						$cache = "style=display:none;";
					}
				}
        ?>
				
				<div class='sequence' id='seq<?php echo $i; ?>' value=<?php echo intval($sequences['sequence'][$i]/$metadiverses['references']);?> <?php echo $cache;?>>
					<div class='sequencenum'><?php echo str_pad($sequences['num'][$i],  2, "0", STR_PAD_LEFT); ?></div>
					<div class='sequencetitre'><a onClick="change_class('seq<?php echo $i; ?>', <?php echo intval($sequences['sequence'][$i]/intval($metadiverses['references']));?>)" title='<?php echo $sequences['descr'][$i];?>'><?php echo $sequences['descr'][$i];?></a></div>
					<div class='sequenceduree'><?php echo (NemateriaHelperUtils::get_temps($sequences['duree'][$i], $metadiverses['references']));?></div>
					<div></div>
				</div>
        <?php endfor; ?>
        </div>
		<?php endif; ?>
        
		<!-- Informations -->
        
     </article>
    
	<?php include_once(JPATH_COMPONENT.'/helpers/html/onglets.php'); ?>
</section>