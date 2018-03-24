<?php
	// no direct access
	defined('_JEXEC') or die('Restricted access');
	
	$document = JFactory::getDocument();
	
	$document->addStyleSheet('components/com_exlineo/assets/css/recherche.css');
	$document->addScript('components/com_exlineo/assets/lib/jwplayer.js');
	$document->addScript('http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
	
	$document->addScript('components/com_exlineo/assets/lib/infos.js');
	
	require_once(JPATH_ROOT.DS.'components/com_exlineo/assets/lib/actions.php');
			
	// Créer les variables depuis les champs
	$vars = set_variables($this->item->champs);
	
	// RECUPERER LES SEQUENCES
	$sequences = get_tableau($this->item->champs);
?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>"><h2><?php echo $this->params->get('page_title');  ?></h2></div>
<h3><?php echo $this->item->title; ?></h3>
<div class="contentpane">
    <div id="ressource">
        <!-- INSERER UNE VIDEO -->
    <div id="zonevideo">
        <div id='video'></div>
			<script type='text/javascript'>
              jwplayer('video').setup({
                'flashplayer': 'components/com_exlineo/assets/player.swf',
                'file': '400eme.mp3',
                'streamer': 'rtmp://ks368817.kimsufi.com/oflaDemo',
                'controlbar': 'bottom',
                'width': '540',
                'height': '320'
              });
            </script>
     	<?php
			// CREER LES SEQUENCES
			if(count($sequences['sequence']) > 0):
				for ($i=0; $i<count($sequences['sequence']);$i++):
		?>
        <div class='sequence'>
        	<div class='sequencetitre'><a href='#' title='<?php echo $sequences['titre'][$i];?>'><?php echo $sequences['descr'][$i];?></a></div>
            <div class='sequenceduree'><?php echo secondsToWords($sequences['duree'][$i]);?></div>
            <div></div>
        </div>
        <?php endfor; ?>
		<?php endif; ?>
     </div>
     <div id="infos">
         <div class="titre">
            <h3>Informations</h3>
         </div>
            <div class="infos">
            	<?php include_once(JPATH_ROOT.DS.'components/com_exlineo/assets/lib/valeurs_bdd.php'); ?>
           </div>
	</div>
</div>