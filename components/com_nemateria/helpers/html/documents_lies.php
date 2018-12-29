<!-- Condition sur les variables pour afficher les options d'affichage des documents liés -->
	  <div id="docslies"> 
      	<span>Voir les documents associés</span>
        <div class="invisible">
        <?php
	  
	  	if(isset($infos_serie)){
			// Traitement des documents
			if(isset($infos_serie['liens_texte'])){
				NemateriaHelperUtils::tri_liens_liste($infos_serie['liens_texte'], 'texte');
			  };
			  
			  // Traitement des images
			  if(isset($infos_serie['liens_image'])){
				NemateriaHelperUtils::tri_liens_liste($infos_serie['liens_image'], 'images');
			  };
			  
			  // Traitement des audio
			  if(isset($infos_serie['liens_audio'])){
				NemateriaHelperUtils::tri_liens_liste($infos_serie['liens_audio'], 'audio');
			  };
			  // Traitement de la vidéo
			  if(isset($infos_serie['liens_video'])){
				NemateriaHelperUtils::tri_liens_liste($infos_serie['liens_video'], 'video');
			  };
		}else if(isset($metadiverses)){
			// Traitement des documents
			if(isset($metadiverses['liens_texte'])){
				NemateriaHelperUtils::tri_liens_liste($metadiverses['liens_texte'], 'texte');
			  };
			  
			  // Traitement des images
			  if(isset($metadiverses['liens_image'])){
				NemateriaHelperUtils::tri_liens_liste($metadiverses['liens_image'], 'images');
			  };
			  
			  // Traitement des audio
			  if(isset($metadiverses['liens_audio'])){
				NemateriaHelperUtils::tri_liens_liste($metadiverses['liens_audio'], 'audio');
			  };
			  // Traitement de la vidéo
			if(isset($metadiverses['liens_video'])){
				NemateriaHelperUtils::tri_liens_liste($metadiverses['liens_video'], 'video');
			  };
		}
		?>
      	</div>
      </div>