<?php
	// no direct access
	defined('_JEXEC') or die('Restricted access');
	
	$document = JFactory::getDocument();
	
	$document->addScript('components/com_nemateria/assets/JW7/jwplayer.js');
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
?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<h2><?php echo $this->params->get('page_title');  ?></h2>
	<!-- <a href="#" class="bouton" onclick="retourReference('<?php // echo $_SERVER['HTTP_REFERER']; ?>')">Retour aux notices</a>-->
	<a class="bouton" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour aux notices</a>
</div>
<h3><?php echo $this->item->title; ?></h3>
<div class="contentpane">
    <div id="ressource" class="partage">
        <!-- INSERER UNE VIDEO -->
    <div id="zonevideo" class="moitier">
        <div id='video_nemateria'>Il semble que vous n'ayez pas le lecteur Flash. <a href="https://get.adobe.com/fr/flashplayer/" target="_blank">Merci de l'installer pour consulter les ressources multimédia de ce site Internet.</a></div>
			<script type='text/javascript'>
              jwplayer.key='mdg3Hk8Xq/Q0L0njCmlZaJ8yxm0+RjA+DbF9rg==';
			  jwplayer('video_nemateria').setup({
				file:'<?php echo $liens[1]; ?>',
				modes: [
					{ type: 'html5' },
					{ type: 'flash', src: '<?php echo(JURI::base());?>components/com_nemateria/assets/JW7/jwplayer.flash.swf' }
				],
				androidhls:'true',
				skin:{name:'vapor', active:'#FF0000',},
				width:'100%',
				height:30
			  });
			  // Suivre le déroulé de la lecture pour modifier la playliste
			  jwplayer('video_nemateria').on('time', function(e) {
				// Lister les séquences et modifier les classes
				change_playliste(Math.floor(e.position));
			  });
            </script>
			<?php
			  // Ajouter les pictos s'il y a des documents liés
				include("components/com_nemateria/assets/lib/documents_lies.php");
			?>
         <?php if(count($sequences['sequence']) > 0): ?>
         	<h4>Résumés des séquences</h4>
            <div id='sequences'>
			<?php
                // CREER LES SEQUENCES
                for ($i=0; $i<count($sequences['sequence']);$i++):
            ?>
            <?php 
				// Au cas ou la fréquence de l'audio ne soit pas renseigné
				if(!isset($vars['isReferencedBy'])){
					$vars['isReferencedBy'] = '44100';
				}
			?>
           
            <!-- Création des séquences -->
            
            <?php
				$cache='';
				// Vérifier s'il existe des liens ou des renvois vers des PDF dans la description de la séquence
				if(strrpos($sequences['descr'][$i], "#page") !== false || strrpos($sequences['descr'][$i], "http") !== false){
					$cache = "style=display:none;";
				}
			?>
               	
                <div class='sequence' id='seq<?php echo $i; ?>' value=<?php echo intval($sequences['sequence'][$i]/$vars['isReferencedBy']);?> <?php echo $cache;?>>
					<div class='sequencenum'><?php echo str_pad($sequences['num'][$i],  2, "0", STR_PAD_LEFT); ?></div>
					<div class='sequencetitre'><a onClick="change_class('seq<?php echo $i; ?>', <?php echo intval($sequences['sequence'][$i]/$vars['isReferencedBy']);?>)" title='<?php echo $sequences['descr'][$i];?>'><?php echo $sequences['descr'][$i];?></a></div>
					<div class='sequenceduree'><?php echo (get_temps($sequences['duree'][$i], $vars['isReferencedBy']));?></div>
				</div>
            <?php
				// else:
			?>
        <?php endfor; ?>
		<?php endif; ?>
        </div>
       </div>
     	<?php include_once(JPATH_ROOT.DS.'components/com_nemateria/assets/lib/onglets.php'); ?>
        
		
     </div>
     
</div>
<!-- ESPACE DE SYNCRHONISATION DU PDF -->
<div id="synchro" class="contentpane"></div>