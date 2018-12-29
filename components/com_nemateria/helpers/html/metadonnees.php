
		<h4>Métadonnées</h4>        
		<ul>
            
			<?php if(isset($metadiverses['relation'])) : ?>
				<?php if(strlen($metadiverses['relation']) > 0) : ?>
					<li><span class='bleu'>Collection</span> : <?php echo $metadiverses['relation']; ?></li>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php if(isset($metadiverses['isPartOf'])) : ?>
				<?php if(strlen($metadiverses['isPartOf']) > 0) : ?>
					<li><span class='bleu'>Thème ou série</span> :  <?php echo $metadiverses['isPartOf']; ?></li>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php if(isset($this->item->title)) : ?>
				<?php if(strlen($this->item->title) > 0) : ?>
					<li><span class='bleu'>Titre</span> : <?php echo $this->item->title; ?></li>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php if(isset($this->item->type)) : ?>
				<?php if(strlen($this->item->type) > 0) : ?>
					<li><span class='bleu'>Type</span> : <?php echo $this->item->type; ?></li>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php if(isset($metadiverses['extent'])) : ?>
				<?php if(strlen($metadiverses['extent']) > 0) : ?>
					<li><span class='bleu'>Support et durée</span> : <?php echo $metadiverses['extent']; ?></li>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php if(isset($this->item->date)) : ?>
				<?php if(strlen($this->item->date) > 0) : ?>
					<li><span class='bleu'>Date</span> : <?php echo $this->item->date; ?></li>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php if(isset($metadiverses['mediator'])) : ?>
				<?php if(strlen($metadiverses['mediator']) > 0) : ?>
					<li><span class='bleu'>Numérisé par</span> : <?php echo $metadiverses['mediator']; ?></li>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php if(isset($this->item->creator)) : ?>
				<?php if(strlen($this->item->creator) > 0) : ?>
					<li><span class='bleu'>Auteur</span> : <?php echo $this->item->creator; ?></li>
				<?php endif; ?>
			<?php endif; ?>

			<?php if(isset($this->item->contributor)) : ?>
				<?php if(strlen($this->item->contributor) > 0) : ?>
					<li><span class='bleu'>Participants</span> : <?php echo $this->item->contributor; ?></li>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php if(isset($this->item->subject)) : ?>
				<?php if(strlen($this->item->subject) > 0) : ?>
					<li><span class='bleu'>Mots clés</span> : <?php $tmp = str_replace("\n",", ", $this->item->subject); echo substr($tmp, 0, strlen($tmp)-2); ?></li>
				<?php endif; ?>
			<?php endif; ?>
			
            <li><span class='bleu'>Référence</span> : <?php  echo $liens[0]; ?></li>
			
			<?php if(strlen($metadiverses['medium']) > 0) : ?>
            <li><span class='bleu'>Nature du support original</span> : <?php echo $metadiverses['medium']; ?></li>
			<?php endif; ?>
			<?php endif; ?>
			
			<?php if(strlen($metadiverses['hasFormat']) > 0) : ?>
            <li><span class='bleu'>Format du master numérique</span> : <?php echo $metadiverses['hasFormat']; ?></li>
			<?php endif; ?>
			<?php endif; ?>
			
			<?php if(strlen($metadiverses['dateCopyrighted']) > 0) : ?>
            <li><span class='bleu'>Propriétaire des supports originaux</span> : <?php echo $metadiverses['dateCopyrighted']; ?></li>
			<?php endif; ?>
			<?php endif; ?>
			
			<?php if(strlen($metadiverses['rightsHolder']) > 0) : ?>
            <li><span class='bleu'>Détenteur des droits</span> : <?php echo $metadiverses['rightsHolder']; ?></li>
			<?php endif; ?>
			<?php endif; ?>
			
			<?php if(strlen($this->item->rights) > 0) : ?>
            <!--<li><span class='bleu'>Conservation des fichiers numériques</span> : <?php // echo $metadiverses['audienceEducationLevel']; ?></li>
            <li><span class='bleu'>Documenté par</span> : (pas de référence vue dans la base)</li>-->
            <li><span class='bleu'>Statut juridique</span> : <?php echo $this->item->rights; ?></li>
			<?php endif; ?>
			<?php endif; ?>
        </ul>