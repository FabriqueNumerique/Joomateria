<!-- Condition sur les variables pour afficher les options d'affichage des documents liés -->
	  <div id="docslies" class="droite"> 
      	<span>Voir les documents associés</span>
        <div class="invisible">
        <?php
	  
	  	if(isset($infos_serie)){
			// Traitement des documents
			if(isset($infos_serie['liens_texte'])){
				tri_liens_liste($infos_serie['liens_texte'], 'texte');
			  };
			  
			  // Traitement des images
			  if(isset($infos_serie['liens_image'])){
				tri_liens_liste($infos_serie['liens_image'], 'images');
			  };
			  
			  // Traitement des audio
			  if(isset($infos_serie['liens_audio'])){
				tri_liens_liste($infos_serie['liens_audio'], 'audio');
			  };
			  // Traitement de la vidéo
			  if(isset($infos_serie['liens_video'])){
				tri_liens_liste($infos_serie['liens_video'], 'video');
			  };
		}else if(isset($vars)){
			// Traitement des documents
			if(isset($vars['liens_texte'])){
				tri_liens_liste($vars['liens_texte'], 'texte');
			  };
			  
			  // Traitement des images
			  if(isset($vars['liens_image'])){
				tri_liens_liste($vars['liens_image'], 'images');
			  };
			  
			  // Traitement des audio
			  if(isset($vars['liens_audio'])){
				tri_liens_liste($vars['liens_audio'], 'audio');
			  };
			  // Traitement de la vidéo
			if(isset($vars['liens_video'])){
				tri_liens_liste($vars['liens_video'], 'video');
			  };
		}
		?>
      	</div>
      </div>
	  <?php
	  	/*
	  	// Traitement des documents
		if(isset($infos_serie['liens_texte'])){
		  	tri_liens($infos_serie['liens_texte'], 'texte');
		  };
		  
		  // Traitement des images
		  if(isset($infos_serie['liens_image'])){
		  	tri_liens($infos_serie['liens_image'], 'image');
		  };
		  
		  // Traitement des audio
		  if(isset($infos_serie['liens_audio'])){
		  	tri_liens($infos_serie['liens_audio'], 'audio');
		  };
		  // Traitement de la vidéo
      	if(isset($infos_serie['liens_video'])){
		  	tri_liens($infos_serie['liens_video'], 'video');
		  };
		  */
		?>