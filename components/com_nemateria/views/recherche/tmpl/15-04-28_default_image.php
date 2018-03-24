<?php
// no direct access
	defined('_JEXEC') or die('Restricted access');
	require_once(JPATH_ROOT.DS.'components/com_exlineo/assets/lib/actions.php');
	$document = JFactory::getDocument();
	$document->addScript('components/com_exlineo/assets/lib/interactions.js');
	$document->addScript('media/widgetkit/js/jquery.js');
	$document->addScript('components/com_exlineo/assets/jquery.bxslider.min.js');
	$document->addStyleSheet('components/com_exlineo/assets/css/jquery.bxslider.css');
	
		// RECUPERER LES ELEMENTS DE LA CATEGORIE 
		$app = JFactory::getApplication();
		// Catégorie sélectionnée dans l'adresse
		$catID = $app->input->get('cat_id');
		
		// SELECTIONNER LA CATEGORIE POUR AVOIR LES INFOS
		$catId = JRequest::getVar('valeur');
		$db = JFactory::getDBO();
		$db->setQuery("SELECT description, title FROM #__l21_oai25_sets WHERE id_set=".$catId." LIMIT 1");
		$catDesc = $db->loadObject();
				
		// TRIER LES SERIES DISPONIBLES
		$base = JFactory::getDBO();
		// $base->setQuery("SELECT DISTINCT SUBSTRING(champs, LOCATE('isPartOf=', champs)+9, LOCATE('\r\naccessRights', champs) - LOCATE('isPartOf=', champs) - 9) FROM #__l21_oai25_records WHERE champs LIKE '%relation=".$catDesc->title."%'");
		$base->setQuery("SELECT DISTINCT SUBSTRING(champs, LOCATE('isPartOf=', champs)+9, LOCATE('_', champs) - LOCATE('isPartOf=', champs) - 9) FROM #__l21_oai25_records WHERE champs LIKE '%relation=".$catDesc->title."%'");
		
		// LISTE DES THEMES ABORDES
		$themes = $base->loadResultArray();
		
		$serie_actu = "";
		
		// Traitement sur les thèmes pour éviter les erreurs de traitement
		foreach($themes as $c => $v){
			
			if(strpos($_POST['liste_series'])){
				$serie_actu = $c;
			}
			
			if(strlen($v) < 1 || strrpos($v, "=") !== false){
				unset($themes[$c]);
			}
		}
		
		if(!isset($_POST['liste_series'])){
				$_POST['liste_series'] = array_values($themes)[0];
		}
		
		function get_series($s){
			// AFFICHAGE DES PREMIE7RES IMAGE de la première série
			$serie = JFactory::getDBO();
			$serie->setQuery('SELECT * FROM #__l21_oai25_records WHERE champs LIKE "%'.$s.'%"');
			
			// LISTE DES IMAGE DE LA SERIE
			return $serie->loadObjectList();
		}
		// LISTE DES IMAGES D'UNE SERIE
		$img = get_series($_POST['liste_series']);
		
?>
<script type="text/javascript">
	jQuery(document).ready(function(e) {
		 // Créer la liste des themes
		cree_options_boutons(<?php $tp = implode(array_values($themes), ","); echo json_encode($tp);?>, '#serie_choisie')
	  
	  // Enclencher l'interactivité sur les boutons suivants
		jQuery('.bxslider').bxSlider({
		  pagerCustom: '#bx-pager'
		});
		// Ecrire les vignettes (les petites en bas)
        var series = <?php echo json_encode($img); ?>;
		jQuery.each(series, function( key, value ) {
		 	 jQuery("#bx-pager").append('<li><a id="img_'+key+'" data-slide-index="'+key+'" class="vignette" href="" /></a></li>');
			 var adr_tmp = value.identifier;
			 if(adr_tmp.substring(0,4)!="http"){
				 adr_tmp = adr_tmp.substring(10, value.identifier.length);
			}
		  	jQuery("#img_"+key).append('<img src="'+adr_tmp+'" />');
		});
		// Redimensionner les images des cadres (les grandes)
		jQuery.each(jQuery(".cadreimg"), function( key, value ) {
			jQuery(this).height(500);
		});
		
		// LISTE DEROULANTE DES SERIES
		jQuery('#liste_series').change(
			function(){
				jQuery('#serie_choisie').submit();
				// window.location.href = window.location.pathname+"/"+jQuery(this).val();
			});

		// Créer un slide avec les vignettes
		var showNumber = 8;
		var startPos = 0;
		var endPos = showNumber;
		var $List = jQuery('#bx-pager li');
		$List.hide().slice(startPos ,endPos).fadeIn();
		
		jQuery('#suite').click( function() {
			
			if(endPos < jQuery('#bx-pager li').length){
				startPos = startPos + showNumber;
				endPos = endPos + showNumber;
				$List.hide().slice(startPos ,endPos).fadeIn();
				console.log("POSITIONS", startPos, endPos, jQuery('#bx-pager li').length);
			}

			return false;
		});

		jQuery('#avant').click( function() {
			if(startPos > 0){
				startPos = startPos - showNumber;
				endPos = endPos - showNumber;
				$List.hide().slice(startPos, endPos).fadeIn();
				console.log("POSITIONS", startPos, endPos, jQuery('#bx-pager li').length);
				return false;
			}
			
		});
		jQuery('#retour_collections').click(function () {
			 window.history.back();
			return false;
		 });
	});
</script>
<div class="componentheading<?php echo $this->escape($this->get('pageclass_sfx')); ?>">
  <h2><?php echo $this->params->get('page_title');  ?></h2>
  <a href="#" id="retour_collections" class="bouton">Revenir aux collections</a>
</div>
<div id="recherche">
  <div id="themes">
    <div class="titre ligne">
      <h4>Choisir une série / thème</h4>
    </div>
    <form method="post" action="<?php  echo $_SERVER[REQUEST_URI]; ?>" class="ligne" id="serie_choisie">
      <!--<select name="liste_series" id="liste_series" style="margin-bottom:3px;">
        <option value="">Choisissez une série / un thème</option>
      </select>-->
    </form>
  </div>

  <!-- LISTE DES RESSOURCES -->
  <ul class="bxslider">
    <?php foreach ($img as $i => $item) :
            
			//you may want to do this anywhere else				
            $item->slug	= $item->alias ? ($item->id_record.':'.$item->alias) : $item->id_record;				
            $link = JRoute::_('index.php?option=com_exlineo&view=record&id='. $item->slug);
            // echo ("BOUCLE OK");
            // Création des variables à exploiter
            $vars = set_variables($item->champs);
            
            // RECUPERER LES SEQUENCES
            $liens = identifiant_lien($item->identifier);
        ?>
    <li id="cadre">
        <div id="image_<?php  echo $item->id_record; ?>" class="<?php // if(isset($item->format)) echo gere_type($item->format); ?>"> <a href="<?php echo $link ?>" ><img id="img_<?php  echo $item->id_record; ?>" src="<?php  echo $liens[1]; ?>" class="cadreimg" /></a>
          <div class="infos">
            <h3><a href="<?php echo $link ?>">
              <?php  echo $item->title; ?>
              </a></h3>
            <h4>Description</h4>
              <p>
                <?php  echo set_texte($item->description, 300); ?>
              </p>
              <h4>Mots clés</h4>
              <p><?php echo $item->subject; ?></p>
              <p><a href="<?php echo $link ?>" class="droite bas">AGRANDIR</a></p>
              <ul>
              <li>Auteur : <?php echo $item->creator; ?></li>
              <li>Date : <?php echo $item->date; ?></li>
              <li>Lieu : <?php echo $vars['accrualPolicy']; ?></li>
              <li>Référence : <?php echo $liens[0]; ?></li>
              <li>Nature du support original : <?php echo $vars['medium']; ?></li>
              <li>Format du master num : <?php echo $vars['hasFormat']; ?></li>
              <li>Propriétaire : <?php echo $vars['dateCopyrighted']; ?></li>
              <li>Détenteur des droits : <?php echo $vars['rightsHolder']; ?></li>
              <li>Statut juridique : <?php echo $item->rights; ?></li>
            </ul>
            
        </div>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
  <a href="#" id="suite"></a>
  <a href="#" id="avant"></a>
  <ul id="bx-pager">
  </ul>
</div>

<!--<div id="collection-infos" class="tiers box gauche">
  <h3>Infos sur la collection</h3>
 <p><?php // echo $catDesc->description." > Catégorie : ".$catDesc->title; ?></p>
</div>-->
</div>
