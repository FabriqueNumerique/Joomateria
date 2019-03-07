<?php
	// no direct access
    defined('_JEXEC') or die('Restricted access');

	// TRAITER LES METADONNEES DEPUIS LE CHAMP... CHAMPS
    $metadiverses = NemateriaHelperUtils::set_variables($this->item->champs);
    // RECUPERER LES SEQUENCES
    $liens = NemateriaHelperUtils::identifiant_lien($this->item->identifier);
	
	// RECUPERER LES SEQUENCES > Ajout d'un la durée pour calculer le temps : audio : isReferencedBy, video : references
	$sequences = NemateriaHelperUtils::get_tableau($this->item->champs);

?>

<section id="lightbox" class="masque" onclick="lightbox()">
    <article>
		<img />
    </article>
</section>
<header class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<a class="bouton" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour aux notices</a>
    <h2><?php echo $this->params->get('page_title');  ?></h2>
    <h3><?php echo $this->item->title; ?></h3>
</header>
<main class="contentpane">
    <section id="notice" class="partage">
		<?php if(isset($this->item->description)) : ?>
			<p><?php echo $this->item->description; ?></p>
		<?php endif; ?>
		
        <!-- INSERER UNE IMAGE -->
        <article id="zoneimage" class="box">
            <img src="<?php echo $liens[1]; ?>" title="<?php echo $this->item->title; ?>" alt="<?php echo $this->item->title; ?>" onclick="lightbox('<?php echo $liens[1]; ?>')"/>
        </article>
     
        <article class="resultat <?php if(isset($this->item->format)) echo NemateriaHelperUtils::types($this->item->format); ?>">
			<!-- RESUME -->
			<?php if(isset($this->item->metadata)) : ?>
              	<div class="infos">
					<h4>Résumé</h4>
					<?php echo $this->item->metadata; ?>
				</div>
			<?php endif; ?>
              <!-- METADATAS -->
            <div class="meta">
				<?php include_once(JPATH_COMPONENT.'/helpers/html/metadonnees.php'); ?>
              </div>
            </article>
    </section>
</main>