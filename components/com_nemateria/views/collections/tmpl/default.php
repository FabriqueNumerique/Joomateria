<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="componentheading<?php echo $this->escape($this->get('pageclass_sfx')); ?>"><h2><?php echo $this->params->get('page_title');  ?></h2></div>


<main id="recherche">

<?php if(isset($this->series) && count($this->series) > 0): ?>
	<header id="series">
		<?php foreach ($this->series as $s): ?>
		<a href="<?php echo NemateriaHelperUtils::setSerieUrl(JUri::getInstance(), $s);?>" title="<?php echo $s; ?>" class="<?php echo NemateriaHelperUtils::setSerieClasse(urldecode(JUri::getInstance()), $s); ?>" ><?php echo $s; ?></a>
		<?php endforeach; ?>
	</header>
<?php endif; ?>
	
<div class="message invisible"></div>
	
<?php 
    // var_dump($this->items);  
    foreach ($this->items as $i => $item):
    // $tmp_descr = $item->subject;
    
    // if(strlen($item->subject) < 10):
        $item->slug	= $item->alias ? ($item->id_notice.':'.$item->alias) : $item->id_notice;
        $link = JRoute::_('index.php?option=com_nemateria&view=notice&id_notice='.$item->slug);
        // TRAITER LES METADONNEES DEPUIS LE CHAMP... CHAMPS
        $metadiverses = NemateriaHelperUtils::set_variables($item->champs);
        // RECUPERER LES SEQUENCES
        $liens = NemateriaHelperUtils::identifiant_lien($item->identifier);
        $format = NemateriaHelperUtils::types($item->format);
?>
    
    <article class="resultat <?php if(isset($item->format)) echo $format; ?>">
        <div class="image">
			<a href="<?php echo $link ?>">
			<?php if($format == 'image'): ?>
            	<img src="<?php echo $liens[1]; ?>" alt="<?php  echo $item->title; ?>" class="image">
			<?php else : ?>
				<div style="background-image:url(<?php echo JURI::root(); ?>images/collections/vignettes/<?php echo trim($liens[0]); ?>.jpg)" class="vignette"></div>
			<?php endif; ?>
			</a>
        </div>
        <div class="infos">
            <h3><a href="<?php echo $link ?>"><?php  echo $item->title; ?></a></h3>
            <p>
			<?php  if(isset($item->creator)) echo $item->creator; ?>
			<?php  // if(isset($metadiverses['accrualMethod'])) echo $metadiverses['accrualMethod'].", "; if(isset($metadiverses['accrualPeriodicity'])) echo $metadiverses['accrualPeriodicity']; ?></p>
            <p><?php  echo NemateriaHelperUtils::set_texte($item->description, 375); ?></p>
        </div>    
    
        <div class="picto">
            <p><a href="<?php echo $link ?>"><img src="<?php echo JURI::root(); ?>images/icones/media_lecture.png" class="picto-media"></a></p>
            <p class="lire_suite"><a href="<?php echo $link ?>"><img src="<?php echo JURI::root(); ?>images/icones/media_<?php echo $format; ?>_mini.png" class="picto-media-mini"></a></p>
        </div>
        <div class="meta">
            <?php  echo $item->type; ?><br/>
            <?php  if(isset($metadiverses['extent'])) echo $metadiverses['extent'].'<br/>'; ?>
            <?php  if(isset($sequences)) echo $sequences.' séquences'.'<br/>'; ?>
            Langue : <?php  echo $item->language.'<br/>'; ?>
            Réf. : <?php  echo $liens[0].'<br/>'; ?>
            Date : <?php  echo $item->date; ?>
        </div>
    </article>
    <?php // endif; ?>
<?php endforeach; ?>
<!-- AJOUT DE LA PAGINATION JOOMLA -->
<?php 
	if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative){
		echo $this->item->pagination;
	}
	// echo $this->pagination->getListFooter();
	?>
</main>
 