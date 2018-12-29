<?php
// no direct access
	defined('_JEXEC') or die('Restricted access');
	require_once(JPATH_ROOT.DS.'components/com_nemateria/assets/lib/actions.php');
	
	$document = JFactory::getDocument();
	$document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
	$document->addScript('components/com_nemateria/assets/lib/infos.js');
?>

<div class="componentheading<?php echo $this->escape($this->get('pageclass_sfx')); ?>">
	<a href="#" id="retour_collections" class="bouton retour_collections">Voir d'autres collections</a>
    <h2><?php echo $this->params->get('page_title');  ?></h2>
</div>

<div id="recherche">
	<?php foreach ($this->items as $i => $item) : 
		$tmp_descr = $item->subject;
		if(strlen($item->subject) < 10):
		// if(strpos($tmp_descr, "descriptif") === false) :
			//you may want to do this anywhere else				
			$item->slug	= $item->alias ? ($item->id_notice.':'.$item->alias) : $item->id_notice;
			$link = JRoute::_('index.php?option=com_nemateria&view=notice&id='. $item->slug);
			
			// Création des variables à exploiter
			$vars = set_variables($item->champs);
			
			// RECUPERER LE LIEN VERS LA RESSOURCE
			$liens = identifiant_lien($item->identifier);
		// echo "Longueur : ".strlen($item->subject);
	?>
    
    <div class="resultat <?php if(isset($item->format)) echo gere_type($item->format); ?>">
        	<div class="meta">
            	  <p><?php  echo $item->type; ?></p>
                  <p><?php  if(isset($vars['extent'])) echo $vars['extent']; ?></p>
            	  <?php  if(isset($sequences)) echo '<p>'.$sequences.' séquences</p>'; ?>
                  <p>Langue : <?php  echo $item->language; ?></p>
            	  <p>Réf. : <?php  echo $liens[0]; ?></p>
            	  <p>Date : <?php  echo $item->date; ?></p>
            	</div>
                <div class="picto">
                  <p><a href="<?php echo $link ?>"><img src="<?php echo JURI::root(); ?>images/icones/media_lecture.png" class="picto-media"></a></p>
                  <p class="lire_suite"><a href="<?php echo $link ?>"><img src="<?php echo JURI::root(); ?>images/icones/media_<?php if(isset($item->format)) echo gere_type($item->format); ?>_mini.png" class="picto-media-mini"></a></p>
            </div>
            <div class="image"><a href="<?php echo $link ?>"><img src="<?php echo JURI::root(); ?>images/collections/vignettes/<?php echo $liens[0]; ?>.jpg" alt="<?php  echo $item->titre; ?>" class="image"></a></div>
            <div class="infos">
              <h3><a href="<?php echo $link ?>"><?php  echo $item->title; ?></a></h3>
              <p>
			  <?php  if(isset($item->creator)) echo $item->creator; ?>
			  <?php  // if(isset($vars['accrualMethod'])) echo $vars['accrualMethod'].", "; if(isset($vars['accrualPeriodicity'])) echo $vars['accrualPeriodicity']; ?></p>
              <p><?php  echo set_texte($item->description, 375); ?></p>
        	</div>
         </div>
         <?php endif; ?>
<?php endforeach; ?>
<!-- AJOUT DE LA PAGINATION JOOMLA -->
<?php echo $this->pagination->getListFooter(); ?>
</div>