<?php
// no direct access
	defined('_JEXEC') or die('Restricted access');
	require_once(JPATH_ROOT.DS.'components/com_nemateria/assets/lib/actions.php');
?>
<div class="componentheading<?php echo $this->escape($this->get('pageclass_sfx')); ?>"><h2><?php echo $this->params->get('page_title');  ?></h2></div>

<div id="recherche">
	<h3>Images de la collection</h3>
	<?php foreach ($this->items as $i => $item) : 
		//you may want to do this anywhere else				
		$item->slug	= $item->alias ? ($item->id_notice.':'.$item->alias) : $item->id_notice;
		$link = JRoute::_('index.php?option=com_nemateria&view=notice_image&id='. $item->slug);
				
		// Création des variables à exploiter
		$vars = set_variables($item->champs);
		
		// RECUPERER LES SEQUENCES
		$liens = identifiant_lien($item->identifier);
	?>
    
    <div class="vignette">
        	<!--
            <div class="meta">
            	  <p><?php  // if(isset($vars['extent'])) echo $vars['extent']; ?></p>
            	  <?php  // if(isset($sequences)) echo '<p>'.$sequences.' séquences</p>'; ?>
            	  <p>Réf. : <?php // echo $item->identifier; ?></p>
            	  <p>Date : <?php // echo $item->date; ?></p>
            	</div>
                <div class="picto">
                  <p><img src="<?php // echo JURI::root(); ?>images/icones/media_<?php // if(isset($item->format)) echo gere_type($item->format); ?>.png" width="50" height="50"></p>
                  <p><a href="<?php // echo $link ?>"><img src="<?php // echo JURI::root(); ?>images/icones/media_lecture.png" width="50" height="50"></a></p>
            </div>
            -->
            <div class="image"><a href="<?php echo $link ?>"><img src="<?php echo $liens[1]; ?>" alt="" width="200" height="200" class="image"></a></div>
            <!--
            <div class="infos">
              <h3><?php  // echo $item->title.' ('.$item->id_record.')'; ?></h3>
              <p><?php  // if(isset($vars['accrualMethod'])) echo $vars['accrualMethod'].", "; if(isset($vars['accrualPeriodicity'])) echo $vars['accrualPeriodicity']; ?></p>
              <p><?php  // echo $item->description; ?></p>
        	</div>
            -->
         </div>
<?php endforeach; ?>
<!-- AJOUT DE LA PAGINATION JOOMLA -->
</div>

<?php echo $this->pagination->getListFooter(); ?>