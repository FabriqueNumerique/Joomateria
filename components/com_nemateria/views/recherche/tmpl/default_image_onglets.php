<?php
// no direct access
	defined('_JEXEC') or die('Restricted access');
	require_once(JPATH_ROOT.DS.'components/com_nemateria/assets/lib/actions.php');
	$document = JFactory::getDocument();
	$document->addScript('components/com_nemateria/assets/lib/interactions.js');
	
	// $document->addScript('media/widgetkit/js/jquery.js'); 
	$document->addScript('http://code.jquery.com/jquery-1.10.2.js');
	$document->addScript('components/com_nemateria/assets/jquery.bxslider.min.js');
	$document->addScript('http://code.jquery.com/ui/1.11.4/jquery-ui.js'); // http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css
	$document->addStyleSheet('components/com_nemateria/assets/css/jquery.bxslider.css');
	$document->addStyleSheet('http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
	$document->addScript('components/com_nemateria/assets/lib/infos.js');
	
		// RECUPERER LES ELEMENTS DE LA CATEGORIE 
		$app = JFactory::getApplication();
		// Catégorie sélectionnée dans l'adresse
		$catID = $app->input->get('cat_id');
		
		// SELECTIONNER LA CATEGORIE POUR AVOIR LES INFOS
		$catId = JRequest::getVar('valeur');
		$db = JFactory::getDBO();
		$db->setQuery("SELECT description, title FROM #__nemateria_collections WHERE id_collection=".$catId." LIMIT 1");
		$catDesc = $db->loadObject();
						
		// TRIER LES SERIES DISPONIBLES
		$base = JFactory::getDBO();
		// $base->setQuery("SELECT DISTINCT SUBSTRING(champs, LOCATE('isPartOf=', champs)+9, LOCATE('\r\naccessRights', champs) - LOCATE('isPartOf=', champs) - 9) FROM #__l21_oai25_records WHERE champs LIKE '%relation=".$catDesc->title."%'");
		$base->setQuery("SELECT DISTINCT SUBSTRING(champs, LOCATE('isPartOf=', champs)+9, LOCATE('accessRights', champs) - LOCATE('isPartOf=', champs) - 9) FROM #__nemateria_notices WHERE champs LIKE '%relation=".$catDesc->title."%' ORDER BY language ASC");
		
		// LISTE DES THEMES ABORDES
		$themes = $base->loadResultArray();
		
		$serie_actu = "";
		
		
		
		// Traitement sur les thèmes pour éviter les erreurs de traitement (...)
		foreach($themes as $c => $v){
			
			if(strpos($_POST['liste_series'])){
				$serie_actu = $c;
			}
			
			if(strlen($v) < 1 || strrpos($v, "=") !== false){
				unset($themes[$c]);
				// unset($themes[tri_series($c)]);
			}
			
			$themes[$c] = tri_series($v);
			
		}
		
		// Traitement sur le tableau pour éviter les doublons et avoir un ordre alphabétiques des séries
		$themes = array_unique($themes);
		asort($themes);
		
		if(!isset($_POST['liste_series'])){
				$_POST['liste_series'] = array_values($themes)[0];
				
		}
		
		// Eviter les chiffres en fin de série =< Fonction à supprimer dès que possible
		function tri_series($val){
			if(strpos($val, '_')){
				$val = substr($val, 0, strpos($val, '_'));
			}
			return $val;
		}
		
		function get_series($s){
			// AFFICHAGE DES PREMIE7RES IMAGE de la première série
			$serie = JFactory::getDBO();
			// $serie->setQuery('SELECT * FROM #__l21_oai25_records WHERE champs LIKE "%'.$s.'%" ORDER BY identifier ASC');
			$serie->setQuery('SELECT * FROM #__nemateria_notices WHERE champs LIKE "%'.$s.'%"');
			
			// LISTE DES IMAGE DE LA SERIE
			return $serie->loadObjectList();
		}
		// LISTE DES IMAGES D'UNE SERIE
		$img = get_series($_POST['liste_series']);
		
		// asort($img);
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
  <a href="#" id="retour_collections" class="bouton retour_precedent">Revenir aux collections</a>
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
            $item->slug	= $item->alias ? ($item->id_notice.':'.$item->alias) : $item->id_notice;
            $link = JRoute::_('index.php?option=com_nemateria&view=notice&id='. $item->slug);
            // echo ("BOUCLE OK");
            // Création des variables à exploiter
            $vars = set_variables($item->champs);
            
            // RECUPERER LES SEQUENCES
            $liens = identifiant_lien($item->identifier);
        ?>
    <li id="cadre">
        <!-- AFFICHER LE MEDIA -->
        <div id="image_<?php  echo $item->id_notice; ?>"> <a href="<?php echo $link ?>" ><img id="img_<?php  echo $item->id_notice; ?>" src="<?php  echo $liens[1]; ?>" class="cadreimg" /></a>
        
        <!-- AFFICHER LES INFOS --> 
        <div class="infos">
            <!-- ONGLETS -->
            <!-- <div id="tabs" class="ui-tabs ui-widget">
                <ul class="ui-tabs-nav ui-helper-reset ui-widget-header" role="tablist">
                    <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-1" aria-selected="true" aria-expanded="true"><a href="#media_<?php  echo $item->id_notice; ?>" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-1">Nunc tincidunt</a></li>
                    <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-2" aria-labelledby="ui-id-2" aria-selected="false" aria-expanded="false"><a href="#collection_<?php  echo $item->id_notice; ?>" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-2">Proin dolor</a></li>
                    <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-3" aria-labelledby="ui-id-3" aria-selected="false" aria-expanded="false"><a href="#commenter_<?php  echo $item->id_notice; ?>" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-3">Aenean lacinia</a></li>
                </ul>
                <div id="medias_<?php echo $item->id_notice; ?>" aria-labelledby="ui-id-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="false">
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
                          <li>Lieu : <?php echo $vars['accrualPeriodicity'].' ('.$vars['accrualMethod'].')'; ?></li>
                          <li>Référence : <?php echo $liens[0]; ?></li>
                          <li>Nature du support original : <?php echo $vars['medium']; ?></li>
                          <li>Caractéristique de l'original : <?php echo $vars['extent']; ?></li>
                          <li>Format du master num : <?php echo $vars['hasFormat']; ?></li>
                          <li>Propriétaire : <?php echo $vars['dateCopyrighted']; ?></li>
                          <li>Détenteur des droits : <?php echo $vars['rightsHolder']; ?></li>
                          <li>Statut juridique : <?php echo $item->rights; ?></li>
                	</ul>
                </div>
                <div id="collection_<?php echo $item->id_notice; ?>" aria-labelledby="ui-id-2" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="true" style="display: none;">
                    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
                </div>
                <div id="commenter_<?php // echo $item->id_record; ?>" aria-labelledby="ui-id-3" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="true" style="display: none;">
                    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
                    <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
                </div>
            </div>
            -->        
            <div id="tabs">
              <!--
              <ul class="ligne">
                <li><a href="#media_<?php // echo $item->id_record; ?>">Infos média</a></li>
                <li><a href="#collection_<?php // echo $item->id_record; ?>">Infos collection</a></li>
                <li><a href="#commenter_<?php // echo $item->id_record; ?>">Donner votre avis</a></li>
              </ul>
              -->
              <div id="medias_<?php echo $item->id_notice; ?>">
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
                          <li>Lieu : <?php echo $vars['accrualPeriodicity'].' ('.$vars['accrualMethod'].')'; ?></li>
                          <li>Référence : <?php echo $liens[0]; ?></li>
                          <li>Nature du support original : <?php echo $vars['medium']; ?></li>
                          <li>Caractéristique de l'original : <?php echo $vars['extent']; ?></li>
                          <li>Format du master num : <?php echo $vars['hasFormat']; ?></li>
                          <li>Propriétaire : <?php echo $vars['dateCopyrighted']; ?></li>
                          <li>Détenteur des droits : <?php echo $vars['rightsHolder']; ?></li>
                          <li>Statut juridique : <?php echo $item->rights; ?></li>
                	</ul>
              </div>
              <!--
              <div id="collection_<?php // echo $item->id_record; ?>">
                <p>Collection</p>
              </div>
              <div id="commenter_<?php // echo $item->id_record; ?>">
                <p>Commenter</p>
              </div>
              -->
            </div>
            
                
            
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
