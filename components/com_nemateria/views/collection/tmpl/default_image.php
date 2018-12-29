<?php
// no direct access
// liens_video=http://www.immaterielles.org/index.php/liste-inedites/collection-atelfdg/record/2501-Cants-d'amor-e-d'esper#44;-le-testament-des-troubadours
	defined('_JEXEC') or die('Restricted access');
	require_once(JPATH_ROOT.DS.'components/com_nemateria/assets/lib/actions.php');
	$document = JFactory::getDocument();
	
	$document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
	$document->addScript('components/com_nemateria/assets/jquery.bxslider.min.js');
	$document->addStyleSheet('components/com_nemateria/assets/css/jquery.bxslider.css');
	
	$document->addScript('components/com_nemateria/assets/lib/interactions.js');
	$document->addScript('components/com_nemateria/assets/lib/infos.js');
	
		// RECUPERER LES ELEMENTS DE LA CATEGORIE 
		$app = JFactory::getApplication();
		// Catégorie sélectionnée dans l'adresse
		$catID = $app->input->get('cat_id');
		
		// SELECTIONNER LA CATEGORIE POUR AVOIR LES INFOS
		$catId = JRequest::getVar('valeur');
		
		// echo ("Liste série : ".JRequest::getVar('liste_series'));

		$db = JFactory::getDBO();
		$db->setQuery("SELECT description, title, name FROM #__nemateria_collections WHERE id_collection=".$catId." LIMIT 1");
		$catDesc = $db->loadObject();

		$catTitre = $catDesc->title;
		$catNom = $catDesc->name;

		// echo $catDesc;
		// TRIER LES SERIES DISPONIBLES
		$base = JFactory::getDBO();

		$base->setQuery("SELECT DISTINCT SUBSTRING(champs, LOCATE('isPartOf=', champs)+9, LOCATE('accessRights', champs) - LOCATE('isPartOf=', champs) - 9) FROM #__nemateria_notices WHERE champs LIKE '%relation=".$catTitre."%'");
		
		// LISTE DES THEMES ABORDES
		$themes = $base->loadResultArray();
		
		$serie_actu = "";
		
		// Traitement sur le tableau pour éviter les doublons et avoir un ordre alphabétiques des séries
		$themes = array_unique($themes);
		asort($themes);
		// Traitement sur liste_serie de l'URL pour enlever les entités html et éviter les erruers de routage sur les noms des séries
		// $_GET['liste_series'] = html_entity_decode($_GET['liste_series']);
		// echo html_entity_decode($_GET['liste_series']);
		
		// Traitement sur les thèmes pour éviter les erreurs de traitement (...)
		foreach($themes as $c => $v){
			
			if(strpos($_GET['liste_series'])){
				$serie_actu = $c;
			}
			
			// Si la série s'appelle 'Series' c'est une description d'une série, on la sort du tableau
			if(strlen($v) < 1 || strrpos($v, "=") !== false || $v == 'Series'){
				unset($themes[$c]);
			}
			
			// Enlever la fin d'une série si elle est mal nommée
			if(strpos($themes[$c], '_')){
				$themes[$c] = substr($themes[$c], 0, strpos($themes[$c], '_'));
			}
		}
		
		// Sélectionner la première série si aucune n'a été sélectionnée
		if(!isset($_GET['liste_series'])){
			$_GET['liste_series'] = array_values($themes)[0];
		}
		
		// Eviter les chiffres en fin de série =< Fonction à supprimer dès que possible
		function tri_series($val){
			if(strpos($val, '_')){
				$val = substr($val, 0, strpos($val, '_'));
			}
			return $val;
		}
		
		function get_series($s,$nom){
			// AFFICHAGE DES IMAGES de la première série
			$serie = JFactory::getDBO();
			$serie->setQuery('SELECT * FROM #__nemateria_notices WHERE identifier LIKE "%'.$nom.'%" AND champs LIKE "%'.$s.'%" ORDER BY language ASC');
			
			// LISTE DES IMAGE DE LA SERIE
			return $serie->loadObjectList();
		}
		// LISTE DES IMAGES D'UNE SERIE
		$img = get_series($_GET['liste_series'], $catNom);
		// echo $img;
		// if($img[0]->subject == 'descriptif'){
		$serie_actuelle = $img[0]; // récupérer les infos sur la série
		$infos_serie = set_variables($serie_actuelle->champs);
		// }
		array_shift($img); // Supprimer la première entrée : les infos sur la série
		// asort($img);
		// array_unique($img);
		
?>
<script type="text/javascript">
	// jQuery(document).ready(function(e) {
	jQuery(document).one("ready",function(){
		 // Créer la liste des séries / Enlever les espaces et retours à la ligne superflus
		cree_options_boutons(<?php $tp = implode(array_map('trim', array_values($themes)), ","); echo json_encode($tp);?>, '#serie_choisie', "<?php echo rtrim($_GET['liste_series']); ?>")
		
		// Enclencher l'interactivité sur les boutons suivants
		var slideImages = jQuery('.bxslider').bxSlider({
		  pagerCustom: '#bx-pager'
		});
		
		jQuery(document).click(function (event) {
			if(jQuery('#lightbox-right')){
				// Click sur la lightbox pour syncrhoniser le slide de la collection d'images
				jQuery('#lightbox-right').click(function(){slideImages.goToNextSlide();});
				jQuery('#lightbox-left').click(function(){slideImages.goToPrevSlide();});
			}
			// console.log($('#lightbox-right').click());
		});
		
		// Ecrire les vignettes (les petites en bas)
        var series = <?php echo json_encode($img); ?>;
		jQuery.each(series, function( key, value ) {
		 	 jQuery("#bx-pager").append('<li><a id="img_'+key+'" data-slide-index="'+key+'" class="vignette" href="" /></a></li>');
			 var adr_tmp = value.identifier;
			 var titre_tmp = value.title;
			 var descr_tmp = value.description;
			 if(adr_tmp.substring(0,4)!="http"){
				 // adr_tmp = adr_tmp.substring(10, value.identifier.length);
				 adr_tmp = adr_tmp.substring(adr_tmp.indexOf('http'), value.identifier.length);
			}
		  	// jQuery("#img_"+key).append('<img src="'+adr_tmp+'" /><h5>'+titre_tmp+'</h5><p>'+descr_tmp+'</p>');
			jQuery("#img_"+key).append('<img src="'+adr_tmp+'" />');
		});
		
		// Redimensionner les images des cadres (les grandes)
		jQuery.each(jQuery(".cadreimg"), function( key, value ) {
			var tmp_h = jQuery(this).height();
			var tmp_w = jQuery(this).width();
			
				jQuery(this).height(500);
		});
		
		// LISTE DEROULANTE DES SERIES
		/*jQuery('#liste_series').change(
			function(){
				jQuery('#serie_choisie').submit();
				// window.location.href = window.location.pathname+"/"+jQuery(this).val();
		});*/
		
		// Créer un slide avec les vignettes
		var showNumber = 10;
		var startPos = 0;
		var endPos = showNumber;
		var $List = jQuery('#bx-pager li');
		$List.hide().slice(startPos ,endPos).fadeIn();
		
		// Boutons avant - après
		jQuery('#suite').click( function() {
			if(endPos < jQuery('#bx-pager li').length){
				startPos = startPos + showNumber;
				endPos = endPos + showNumber;
				$List.hide().slice(startPos ,endPos).fadeIn();
				// console.log("POSITIONS", startPos, endPos, jQuery('#bx-pager li').length);
			}
			return false;
		});
		
		jQuery('#avant').click( function() {
			if(startPos > 0){
				startPos = startPos - showNumber;
				endPos = endPos - showNumber;
				$List.hide().slice(startPos, endPos).fadeIn();
				// console.log("POSITIONS", startPos, endPos, jQuery('#bx-pager li').length);
				return false;
			}
			
		});
	});
</script>
<div class="componentheading<?php echo $this->escape($this->get('pageclass_sfx')); ?>">
  <a href="#" id="retour_collections" class="bouton retour_collections">Voir d'autres collections</a>
  <h2><?php echo $this->params->get('page_title');  ?></h2>
</div>
<div id="recherche">
  <div id="themes">
    <div class="titre ligne">
    </div>
    <form method="get" action="<?php  echo $_SERVER[REQUEST_URI]; ?>" class="ligne" id="serie_choisie">
      <!--<select name="liste_series" id="liste_series" style="margin-bottom:3px;">
        <option value="">Choisissez une série / un thème</option>
      </select>-->
    </form>
  </div>

  <!-- LISTE DES RESSOURCES -->
  <ul class="bxslider">
    <?php foreach ($img as $i => $item) :
			// Traitement pour identifier le descriptif de la série et l'isoler
				$item->slug	= $item->alias ? ($item->id_notice.':'.$item->alias) : $item->id_notice;
				$link = JRoute::_('index.php?option=com_nemateria&view=notice&id='. $item->slug);
				// echo ("BOUCLE OK");
				// Création des variables à exploiter
				$vars = set_variables($item->champs);
				
				// RECUPERER LES SEQUENCES
				$liens = identifiant_lien($item->identifier);
     ?>
    <li id="cadre">
        <!-- AFFICHER LE MEDIA 
        //  data-lightbox="image-1" data-title="My caption"-->
        <div id="image_<?php  echo $item->id_notice; ?>"><a href="<?php  echo $liens[1]; ?>" data-lightbox="group:serie-<?php if ($i!=0) echo $serie_actuelle->title; ?>" data-title="<?php echo $item->creator; ?>" ><img id="img_<?php  echo $item->id_notice; ?>" src="<?php  echo $liens[1]; ?>" class="cadreimg" /></a>
        
        <!-- AFFICHER LES INFOS --> 
        <div class="infos" data="<?php echo $item->id_notice; ?>">
            <div class="tabs">
              <ul class="tab-links">
                <li class="active"><a href="#media_<?php echo $item->id_notice; ?>">Infos sur l'image</a></li>
                <li><a href="#collection_<?php echo $item->id_notice; ?>">Infos sur la série</a></li>
                <li><a href="#commenter_<?php echo $item->id_notice; ?>">Vos contributions</a></li>
              </ul>
              <!-- -->
              <div class="tab-content">
              <div id="media_<?php echo $item->id_notice; ?>" class="tab active">
                <h3><a href="<?php echo $link ?>">
                      <?php  echo $item->title; ?>
                      </a></h3>
                      <p>
                        <?php echo $item->description;// echo set_texte($item->description, 300);  ?>
                      </p>
                      
                      <p></p>
                      <p></p>
                      <ul>
                          <li><span class='bleu'>Auteur</span> : <?php echo $item->creator; ?></li>
                          <li><span class='bleu'>Date</span> : <?php echo $item->date; ?></li>
                          <li><span class='bleu'>Lieu</span> : <?php echo $vars['accrualPeriodicity'].' ('.$vars['accrualMethod'].')'; ?></li>
                          <li><span class='bleu'>Référence</span> : <?php echo $liens[0]; ?></li>
                          <li><span class='bleu'>Mots clés</span> : <?php $tmp = str_replace("\n",", ", $item->subject); echo substr($tmp, 0, $tmp.length-2); ?></li>
                          <li><span class='bleu'>Nature du support original</span> : <?php echo $vars['medium']; ?></li>
                          <li><span class='bleu'>Caractéristique de l'original</span> : <?php echo $vars['extent']; ?></li>
                          <li><span class='bleu'>Format du master num</span> : <?php echo $vars['hasFormat']; ?></li>
                          <li><span class='bleu'>Propriétaire</span> : <?php echo $vars['dateCopyrighted']; ?></li>
                          <li><span class='bleu'>Editeur</span> : <?php echo $item->publisher; ?></li>
                          <li><span class='bleu'>Détenteur des droits</span> : <?php echo $vars['rightsHolder']; ?></li>
                          <li><span class='bleu'>Statut juridique</span> : <?php echo $item->rights; ?></li>
                	</ul>
                    <!--<h4>Description</h4>-->
                    <?php // echo $item->description; ?>
              </div>
              
              <div id="collection_<?php echo $item->id_notice; ?>" class="tab">
                <h3><?php echo $serie_actuelle->title; ?></h3>
                <p><?php echo $serie_actuelle->description; ?></p>
              </div>
              <div id="commenter_<?php echo $item->id_notice; ?>" class="tab">
                {rsform 3}
                	<script language="javascript" type="text/javascript">
						// jQuery(".formBody #Notice").val(window.location.href);
						jQuery(".formBody #Notice").val('<?php echo rtrim ($liens[0]); ?>');
					</script>
              </div>
              </div>
             <!-- -->
            </div>
            
        </div>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
  
  <?php
  // Ajouter les pictos s'il y a des documents liés
  	include("components/com_nemateria/assets/lib/documents_lies.php");
	?>
      
  	<div class="numero"><?php echo count($img);?> photos</div>
    
    <a href="#" id="suite"></a>
  	<a href="#" id="avant"></a>
    
  <ul id="bx-pager">
  </ul>
</div>
</div>
