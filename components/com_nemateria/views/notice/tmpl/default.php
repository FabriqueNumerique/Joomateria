<?php
	// no direct access
    defined('_JEXEC') or die('Restricted access');
    
	// var_dump($this);	
	// TRAITER LES METADONNEES DEPUIS LE CHAMP... CHAMPS
    // $metadiverses = NemateriaHelperUtils::set_variables($item->champs);
    // RECUPERER LES SEQUENCES
    // $liens = NemateriaHelperUtils::identifiant_lien($item->identifier);
	
	// RECUPERER LES SEQUENCES > Ajout d'un la durée pour calculer le temps : audio : isReferencedBy, video : references
	// $sequences = NemateriaHelperUtils::get_tableau($this->item->champs);

?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<h2><?php echo $this->params->get('page_title');  ?></h2>
	<a class="bouton" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour aux notices</a>
</div>
<h3><?php echo $this->item->title; ?></h3>
<main class="contentpane">
    <section id="ressource" class="partage">
        <!-- INSERER UNE VIDEO -->
        <article id="zoneimage" class="box">
            <img src="<?php echo $lien; ?>"/>
        </article>
     
        <article class="resultat <?php if(isset($item->format)) echo $format; ?>">
              <div class="image" style="background-image:url(<?php echo $liens[1]; ?>)">
                <a href="<?php echo $link ?>"></a>
              </div>
              <div class="infos">
                      <h3><a href="<?php echo $link ?>"><?php  echo $item->title; ?></a></h3>
                      <p>
                      <?php  if(isset($item->creator)) echo $item->creator; ?>
                      <p><?php  echo NemateriaHelperUtils::set_texte($item->description, 375); ?></p>
              </div>    
                
                <div class="picto">
                    <p><a href="<?php echo $link ?>"><img src="<?php echo JURI::root(); ?>images/icones/media_lecture.png" class="picto-media"></a></p>
                    <p class="lire_suite"><a href="<?php echo $link ?>"><img src="<?php echo JURI::root(); ?>images/icones/media_<?php echo $format; ?>_mini.png" class="picto-media-mini"></a></p>
                </div>
                <div class="meta">
                    <p><?php  echo $item->type; ?></p>
                    <p><?php  if(isset($metadiverses['extent'])) echo $metadiverses['extent']; ?></p>
                    <?php  if(isset($sequences)) echo '<p>'.$sequences.' séquences</p>'; ?>
                    <p>Langue : <?php  echo $item->language; ?></p>
                    <p>Réf. : <?php  echo $liens[0]; ?></p>
                    <p>Date : <?php  echo $item->date; ?></p>
                </div>
            </article>
    </section>
</main>