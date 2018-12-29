<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();

$document->addScript('media/com_nemateria/js/jquery.mousewheel.js');
$document->addScript('media/com_nemateria/js/jquery.easing.js');
$document->addScript('media/com_nemateria/js/jquery.flexslider.js');
$document->addScript('media/com_nemateria/js/flexslider.init.js');

$document->addStyleSheet('media/com_nemateria/css/flexslider.css');

/*$document->addScriptOptions('mod_example', array(
    'series_images' => json_encode(implode(array_map('trim', array_values($themes)), ",")),
    'sliderOptions' => array('selector' => '.my-slider', 'timeout' => 300, 'fx' => 'fade')
));*/

?>

<div class="componentheading<?php echo $this->escape($this->get('pageclass_sfx')); ?>"><h2><?php echo $this->params->get('page_title');  ?></h2></div>

<?php
	echo $this->type_collection;
?>

<main id="recherche">
    <header id="themes">
        <div class="titre ligne">
		</div>
		<form method="get" action="<?php  echo $_SERVER[REQUEST_URI]; ?>" class="ligne" id="serie_choisie">
		  <!--<select name="liste_series" id="liste_series" style="margin-bottom:3px;">
			<option value="">Choisissez une série / un thème</option>
		  </select>-->
		</form>
    </header>
    
    <section class="slider">
        <div id="slider" class="flexslider">
            <ul class="slides">
			<?php foreach ($this->items as $i => $item) : 
				//you may want to do this anywhere else				
				$item->slug	= $item->alias ? ($item->id_notice.':'.$item->alias) : $item->id_notice;
				$link = JRoute::_('index.php?option=com_nemateria&view=notice&id='. $item->slug);
				// TRAITER LES METADONNEES DEPUIS LE CHAMP... CHAMPS
				$metadiverses = NemateriadHelperUtils::set_variables($item->champs);
				// RECUPERER LES SEQUENCES
				$liens = NemateriadHelperUtils::identifiant_lien($item->identifier);
				?>
			    <li>
                    <!-- AFFICHER LE MEDIA 
                    //  data-lightbox="image-1" data-title="My caption"-->
                    <a href="<?php  echo $liens[1]; ?>" data-lightbox="group:serie-<?php if ($i!=0) echo $serie_actuelle->title; ?>" data-title="<?php echo $item->creator; ?>" >
                        
                    <img id="img_<?php  echo $item->id_notice; ?>" class="lazy" data-src="<?php  echo $liens[1]; ?>" />
                    
                    </a>

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
                                  <ul>
                                      <li><span class='bleu'>Auteur</span> : <?php echo $item->creator; ?></li>
                                      <li><span class='bleu'>Date</span> : <?php echo $item->date; ?></li>
                                      <li><span class='bleu'>Lieu</span> : <?php echo $metadiverses['accrualPeriodicity'].' ('.$metadiverses['accrualMethod'].')'; ?></li>
                                      <li><span class='bleu'>Référence</span> : <?php echo $liens[0]; ?></li>
                                      <li><span class='bleu'>Mots clés</span> : <?php $tmp = str_replace("\n",", ", $item->subject); echo substr($tmp, 0, $tmp.length-2); ?></li>
                                      <li><span class='bleu'>Nature du support original</span> : <?php echo $metadiverses['medium']; ?></li>
                                      <li><span class='bleu'>Caractéristique de l'original</span> : <?php echo $metadiverses['extent']; ?></li>
                                      <li><span class='bleu'>Format du master num</span> : <?php echo $metadiverses['hasFormat']; ?></li>
                                      <li><span class='bleu'>Propriétaire</span> : <?php echo $metadiverses['dateCopyrighted']; ?></li>
                                      <li><span class='bleu'>Editeur</span> : <?php echo $item->publisher; ?></li>
                                      <li><span class='bleu'>Détenteur des droits</span> : <?php echo $metadiverses['rightsHolder']; ?></li>
                                      <li><span class='bleu'>Statut juridique</span> : <?php echo $item->rights; ?></li>
                                </ul>
                                <!--<h4>Description</h4>-->
                                <?php // echo $item->description; ?>
                          </div>
                        <!-- -->
                          <div id="collection_<?php echo $item->id_notice; ?>" class="tab">
                            <h3><?php echo $serie_actuelle->title; ?></h3>
                            <p><?php echo $serie_actuelle->description; ?></p>
                          </div>
                          <!-- Ajout d'un formulaire pour les commentaires -->
                              <div id="commenter_<?php echo $item->id_notice; ?>" class="tab">
                            <!-- {rsform 3}-->
                                <script language="javascript" type="text/javascript">
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
        </div>
        <!-- NAVIGATION PAR LES VIGNETTES -->
        <div id="carousel" class="flexslider">
            <ul class="slides">
                <?php foreach ($this->items as $i => $item) : ?>
                <li>
                    <img src="<?php  echo $liens[1]; ?>"/>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
</main>