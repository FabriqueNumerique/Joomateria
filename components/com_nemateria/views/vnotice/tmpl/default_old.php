<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.html');
jimport( 'joomla.filesystem.file' );
JLoader::register('FinderHelperLanguage', JPATH_ADMINISTRATOR . '/components/com_finder/helpers/language.php');
FinderHelperLanguage::loadPluginLanguage();
$document = & JFactory::getDocument();
/******************CHAMPS SPECIAUX ISSUENT DU CHAMP CHAMPS : 36***************************/
//mediator => producteur
//alternative => autre auteur
//rightsHolder=> interprete
//hasPart => participant
//isRequiredBy => snot_auteur
//isVersionOf=> snot_titre
//isReplacedBy => snot_titreconv
//isFormatOf => snot_distribmus
//accessRights => edition
//isPartOf => presentation
//licence => editeurpubli
//hasFormat => impression
//instructionalMethod => descriptmaterielle
//accrualPolicy => descriptmusicale
//created => distribmusicale
//modified => reproduction
//extent => collection
//valid => lien_collection
//hasVersion => note
//abstract => indidewey
//tableOfContents=> rubriclassement
//bibliographicCitation => numnotice
//spatial => distributeur
//educationLevel => theme
//replaces => genre
//requires => typologie
//conformsTo => identif_commerce
//isReferencedBy => identif_relation
//medium => typologie_objet
//provenance => source_publisher
//issued => locinsee
//accrualMethod => spatial_x
//accrualPeriodicity => spatial_y
//audience => metier
//temporal => periode
//available => lienpagesite
///*****PAS UTILISE
/*         * ********dateAccepted = DATEENREGISTREMENT************* OK */
//            if (isset($row->dateAccepted)) {
//                echo '<tr>';
//                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_DATEENREGISTREMENT') . '</span>';
//                echo '<span class="record"> : ' . $row->dateAccepted . '</span>';
//                echo '</td></tr>';
//            }
//        /*         * ********FORMAT************* */
//        if ($row->format && $this->params->get('format') == '0') {
//            echo '<tr>';
//            echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_FORMAT') . ' : </strong><br />';
//            $format = str_ireplace("\r", "", $row->format);
//            echo '<span class="record"> : ' . $format . '</span>';
//            echo '</td></tr>';
//        }
        
//        /*         * ********RELATION************* */
//        if ($row->relation && $this->params->get('relation') == '0') {
//            echo '<tr>';
//            echo '<td><span class="notice_title">'  . JText::_('COM_L21OAI25_RELATION') . ' : </strong></td>';
//            echo '<div class="record">:<a  href="' . $row->relation . '" target=_blank>  Lien l\'entrepot d\'origine  </a></td>';
//        }
//        
       
//        /*         * ********DATESTAMP************* */
//        if ($row->datestamp && $this->params->get('datestamp') == '0') {
//            echo '<tr>';
//            echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_MAJ') . '</span>';
//            $datestamp = str_ireplace("\r", "", $row->datestamp);
//            echo '<span class="record"> : ' . JHTML::Date($datestamp) . '</span>';
//            echo '</td></tr>';
//        }
        /*         * ********dateSubmitted = DATEDEPOT************* OK */
//        if (isset($row->dateSubmitted)) {
//            echo '<tr>';
//            echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_DATEDEPOT') . '</span>';
//            echo '<span class="record"> : ' . $row->dateSubmitted . '</span>';
//            echo '</td></tr>';
//        }
/*         * ********isReplacedBy = SNOT_TITRECONV************* */
//            if (isset($row->isReplacedBy)) {
//                echo '<tr>';
//                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_SNOT_TITRECONV') . '</span>';
//                echo '<span class="record"> : ' . $row->isReplacedBy. '</span>';
//                echo '</td></tr>';
//            }
 /*         * ********SOURCE = LIEN INTERNET************* */
//        if ($row->source && $this->params->get('source') == '0') {
//            echo '<tr>';
//            echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_SOURCE') . '</span>';
//            $source = str_ireplace("\r", "", $row->source);
//           echo '<span class="record"> : ' . $source . '</span>';
//            echo '</td></tr>';
//        }
        /*         * ********PUBLISHER = ETABLISSEMENT************* */
//            if ($row->publisher && $this->params->get('editeur') == '0') {
//                echo '<tr>';
//                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_ETABLISSEMENT') . '</span>';
//                $publisher = str_ireplace("\r", "", $row->publisher);
//                echo '<span class="record"> : ' . $publisher . '</span>';
//                echo '</td></tr>';
//            } 
            /*         * ********acessRights = EDITION************* OK */
//            if (isset($row->acessRights)) {
//                echo '<tr>';
//                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_EDITION') . '</span>';
//                echo '<span class="record"> : ' . $row->acessRights. '</span>';
//                echo '</td></tr>';
//            }
            /*         * ********isPartOf = PRESENTATION************* OK */
//            if (isset($row->isPartOf)) {
//                echo '<tr>';
//                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_PRESENTATION') . '</span>';
//                echo '<span class="record"> : ' . $row->isPartOf. '</span>';
//                echo '</td></tr>';
//            }
            /*         * ********abstract = INDIDEWEY************* ?? */
//            if (isset($row->abstract)) {
//                echo '<tr>';
//                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_INDIDEWEY') . '</span>';
//                echo '<span class="record"> : ' . $row->abstract . '</span>';
//                echo '</td></tr>';
//            }
            /*         * ********provenance = SOURCE_PUBLISHER************* OK */
//            if (isset($row->provenance)) {
//                echo '<tr>';
//                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_SOURCE_PUBLISHER') . '</span>';
//                echo '<span class="record"> : ' . $row->provenance . '</span>';
//                echo '</td></tr>';
//            }
            /*         * ********bibliographicCitation = NUMNOTICE************* OK */
//            if (isset($row->bibliographicCitation)) {
//                echo '<tr>';
//                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_NUMNOTICE') . '</span>';
//                echo '<span class="record"> : ' . $row->bibliographicCitation . '</span>';
//                echo '</td></tr>';
//            }
            /*         * ********hasFormat = IMPRESSION************* OK */
//            if (isset($row->hasFormat)) {
//                echo '<tr>';
//                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_IMPRESSION') . '</span>';
//                echo '<span class="record"> : ' . $row->hasFormat . '</span>';
//                echo '</td></tr>';
//            }
            /*         * ********available = LIENPAGESITE************* OK */
//            if (isset($row->available)) {
//                echo '<tr>';
//                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_LIENPAGESITE') . '</span>';
//                echo '<span class="record"> : ' . $row->available . '</span>';
//                echo '</td></tr>';
//            }
            /*         * ********RIGHTS = DROITS************* */
//            if ($row->rights && $this->params->get('droit') == '0') {
//                echo '<tr>';
//                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_RIGHTS') . '</span>';
//                $rights = str_ireplace("\r", "", $row->rights);
//                echo '<span class="record"> : ' . $rights . '</span>';
//                echo '</td></tr>';
//            }
            /*         * ********medium = TYPOLOGIE_OBJET************* OK */
//            if (isset($row->medium)) {
//                echo '<tr>';
//                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_TYPOLOGIE_OBJET') . '</span>';
//                echo '<span class="record"> : ' . $row->medium . '</span>';
//                echo '</td></tr>';
//            }
        /*         * ********issued = LOCINSEE************* OK */
//        if (isset($row->issued)) {
//            echo '<tr>';
//            echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_LOCINSEE') . '</span>';
//            echo '<span class="record"> : ' . $row->issued . '</span>';
//            echo '</td></tr>';
//        }

        /*         * ********audience = METIER************* OK */
//        if (isset($row->audience)) {
//            echo '<tr>';
//            echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_METIER') . '</span>';
//            echo '<span class="record"> : ' . $row->audience . '</span>';
//            echo '</td></tr>';
//        }  
        /*         * ********modified = REPRODUCTION************* OK */
//        if (isset($row->modified)) {
//            echo '<tr>';
//            echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_REPRODUCTION') . '</span>';
//            echo '<span class="record"> : ' . $row->modified . '</span>';
//            echo '</td></tr>';
//        } 
        /*         * ********hasVersion = NOTE************* OK */
//        if (isset($row->hasVersion)) {
//            echo '<tr>';
//            echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_NOTE') . '</span>';
//            echo '<span class="record"> : ' . $row->hasVersion . '</span>';
//            echo '</td></tr>';
//        }
        /*         * ********tableOfContent = RUBRICLASSEMENT************* OK */
//        if (isset($row->tableOfContent)) {
//            echo '<tr>';
//            echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_RUBRICLASSEMENT') . '</span>';
//            echo '<span class="record"> : ' . $row->tableOfContent . '</span>';
//            echo '</td></tr>';
//        }
///***********************************Ces champs spéciaux sont spécifiques à SondAqui et son ré-injecté en amont dans view.html.php
foreach ($this->notice as $row) {
    $document->setMetaData('keywords', $row->metadata);
}
?>
<div id="notice2" style="color:#000;">

    <?php
    foreach ($this->notice as $row) {
        //Préparation des données
        //Suppréssion des anti-slash lors de la lectures des enregistrement de la BDD
        $row->title = stripcslashes($row->title);
        $row->creator = stripcslashes($row->creator);
        $row->subject = stripcslashes($row->subject);
        $row->description = stripcslashes($row->description);
        $row->publisher = stripcslashes($row->publisher);
        $row->contributor = stripcslashes($row->contributor);
        $row->date = stripcslashes($row->date); //L21oai
        $row->type = stripcslashes($row->type);
        $row->format = stripcslashes($row->format);
        $row->identifier = stripcslashes($row->identifier);
        $row->source = stripcslashes($row->source);
        $row->language = stripcslashes($row->language);
        $row->relation = stripcslashes($row->relation);
        $row->coverage = stripcslashes($row->coverage);
        $row->rights = stripcslashes($row->rights);
        /*$row->champs = stripcslashes($row->champs); => Champs supprimé qui contenait les champs spéciaux*/
        $row->coverage = stripcslashes($row->coverage);

        //Affichage des informations de la notice suivant les enregistrement dans la BDD
        /*         * ********TITLE************* */
        if ($this->params->get('titre') == '0') {
	    echo '<div class="module-title-surround">';
	    	echo '<div class="module-title">';
            		echo '<h2 class="title" >';
            		        if(isset($row->isReplacedBy) || isset($row->isVersionOf)){//Si on a le titre snot OU le titre snot conv, c'est qu'on est dans une snot
            		            if(isset($row->isReplacedBy) && $row->isReplacedBy != ""){//Si on a le titre snot conv, on l'affiche
            		                $title = str_ireplace("\r", "", $row->isReplacedBy);
            		            }
            		            elseif(isset($row->isVersionOf)){//Si non on affiche le titre
            		                $title = str_ireplace("\r", "", $row->isVersionOf);
            		            }
            			}
            			else{//Si on a pas les titres snot c'est qu'on est dans une notice classique
            			    if(isset($row->description) && $row->description != ""){//Si on a le titre conv, on l'affiche
            		                $title = str_ireplace("\r", "", $row->description);
            		            }
            		            elseif(isset($row->title)){//Si non on affiche le titre
            		                $title = str_ireplace("\r", "", $row->title);
            		            }
            			}
            			/*****************************************************************/

           			
           			echo JHtml::_('string.truncate', $title, 60);
            			//echo $title;
            		echo '</h2>';
            	echo '</div>';
            	echo '<div class="social_net">';
	            if ($this->params->get('Facebook') == '0') {
	                echo '<p id="reseauxFb" class="fb-like" data-send="false" data-layout="button_count" data-width="15" data-show-faces="false"></p>';
	            }
	            if ($this->params->get('Twiter') == '0') {
	                echo '<p id="reseauxTwit"><a href="http://twitter.com/share" title="partager sur Twiter" class="twitter-share-button">Tweet</a></p>';
	            }
            	echo '</div>';
            echo '</div>';		
	    
        }
	/*         * ********MINIATURE************* */
                //$miniature = "images/exlineo/images/".$row->relation;
                //$image = "images/exlineo/images/".$row->relation;
                //$miniature = "images/mediajaufre_thumb.jpg";
                //$image = "images/".$row->relation;
                $miniature = "images/exlineo/".$row->id_store."/".$row->id_record."_thumb.jpg";
                $image = "images/exlineo/".$row->id_store."/".$row->id_record.".jpg";
            if ($this->params->get('miniature') == '0') {
                echo '<div id="thumb">';
                if (!JFile::exists($miniature) && !JFile::exists($image)) {
                    $miniature = "images/exlineo/medias/articles.jpg";
                    echo '<div id="content">';
                    //echo '<a href="' . ($chaine) . '"  >';
                    echo '<img alt="' . $row->title . '" src="' . $miniature . '" title="' . $row->title . '" style="/*border: thin dotted #6B0707;*/ max-width:150px; max-height:150px"/>';
                    echo '</div>';
                } else {
                    echo '<div id="content">';
                    echo '<a href="' . $image . '" class="jqzoom" style="" title="' . $row->title . '" >';
                    echo '<img alt="' . $row->title . '" src="' . $miniature . '" title="' . $row->title . '" style="/*border: thin dotted #6B0707;*/ max-width:150px; max-height:150px"/>';
                    echo '</a>';
                    echo '</div>';
                }
            }
            if ($row->local_link && $this->params->get('locallink') == '0') {
		 //echo '<div id="player">';
		 /**/
                 echo '<input id="mymp3" type="hidden" value="'.$this->mp3.'" />';
                 //echo '<div id="jquery_jplayer_1" class="cp-jplayer"></div>';
                echo $this->player;
                //echo '</div>';	
	    }
            
            /*Fin div zone vignette*/
            //if ($this->params->get('miniature') == '0') {
                echo '</div>';
            //}
            /****DIV 2 premier tab gauche droite**********/
            echo '<div class="divtab1">';
        /************* FIN INFORMATIONS GENERIQUE A COTE VIGNETTE *******************/
        /************* TABLE 1 SNOT*******************/
        if(isset($row->isVersionOf) || isset($row->isRequiredBy) || isset($row->isReplacedBy) || isset($row->isFormatOf)){
            echo '<table class="notice2 tab1 snot">';
            /*         * ********isVersionOf = SOUSNOTICETITRE************* */
            if (isset($row->isVersionOf)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_SNOTTITLE') . '</span>';
                if(!isset($row->isReplacedBy)){
                    echo '<span class="record"> : ' . $row->isVersionOf. '</span>';
                }
                else{
                    echo '<span class="record"> : ' . $row->isVersionOf.' ['.$row->isReplacedBy.']</span>';
                }
                echo '</td></tr>';
            }
            /*         * ********isRequiredBy = SOUSNOTICEAUTEUR************* */
            if (isset($row->isRequiredBy)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_SNOTCREATOR') . '</span>';
                echo '<span class="record"> : ' . $row->isRequiredBy. '</span>';
                echo '</td></tr>';
            }
            /*         * ********isFormatOf = SNOT_DISTRIBMUS************* OK */
            if (isset($row->isFormatOf)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_SNOT_DISTRIBMUS') . '</span>';
                echo '<span class="record"> : ' . $row->isFormatOf. '</span>';
                echo '</td></tr>';
            }
            /*fin table1 snot*/
            echo '</table>';
         }
         /***************   TABLE 2  *************************/		 
        echo '<table class="notice2 tab2">';
            /*         * ********TYPE = TYPE DE DOCUMENT************* */
            if ($row->type && $this->params->get('type') == '0') {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_TYPE') . '</span>';
                $type = str_ireplace("\r", "", $row->type);
                echo '<span class="record"> : ' . $type . '</span>';
                echo '</td></tr>';
            }
            /*         * ********SUBJECT = SUJET************* */
            if ($row->subject && $this->params->get('sujets') == '0') {
                echo '<tr>';
                echo'<td><span class="notice_title">' . JText::_('COM_L21OAI25_SUBJECT') . '</span>';
                $sub = str_ireplace("\r", "", $row->subject);
                echo '<span class="record"> : ' . $sub . '</span>';
                echo '</td></tr>';
            }
            /*         * ********educationLevel = THEME************* OK */
            if (isset($row->educationLevel)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_THEME') . '</span>';
                echo '<span class="record"> : ' . $row->educationLevel. '</span>';
                echo '</td></tr>';
            }
             /*         * ********temporal = PERIODE************* OK */
            if (isset($row->temporal)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_PERIODE') . '</span>';
                echo '<span class="record"> : ' . $row->temporal . '</span>';
                echo '</td></tr>';
            }
            /*         * ********replaces = GENRE************* OK */
            if (isset($row->replaces)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_GENRE') . '</span>';
                echo '<span class="record"> : ' . $row->replaces . '</span>';
                echo '</td></tr>';
            }
            /*         * ********LANGUAGE = LANGUE************* */
            if ($row->language && $this->params->get('langage') == '0') {
                echo '<tr>';
                echo '<td><span class="notice_title">'  . JText::_('COM_L21OAI25_LANGAGE') . '</span>';
                $language = str_ireplace("\r", "", $row->language);
                echo '<span class="record"> : ' . $language . '</span>';
                echo '</td></tr>';
            }
            /*         * ********requires = TYPOLOGIE************* OK */
            if (isset($row->requires)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_TYPOLOGIE') . '</span>';
                echo '<span class="record"> : ' . $row->requires . '</span>';
                echo '</td></tr>';
            }          
        /*FIN TABLE 2*/
        echo '</table>';
        /************* TABLE 1 *******************/
            echo '<table class="notice2 tab1">';
            if(isset($row->isVersionOf) || isset($row->isRequiredBy) || isset($row->isReplacedBy) || isset($row->isFormatOf)){
            echo '<tr><td><p><b>'.JText::_('COM_L21OAI25_SNOT_IN').'</b></p></tr></td>';
        }
            /*         * ********title = TITRE************* */
            if ($row->title && $this->params->get('titre') == '0') {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_TITLE') . '</span>';
                $title = str_ireplace("\r", "", $row->title);
                echo '<span class="record"> : ' . $title. '</span>';
                echo '</td></tr>';
            }
            /*         * ********creator = AUTEUR************* */
            if ($row->creator && $this->params->get('createur') == '0') {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_CREATOR') . '</span>';
                $creator = str_ireplace("\r", " - ", $row->creator);
                $creator = substr($creator,0,-3);
                echo '<span class="record"> : ' . $creator . '</span>';
                echo '</td></tr>';
            }
            /*         * ********alternative = AUTREAUTEUR************* */
            if (isset($row->alternative)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_AUTRECREATEUR') . '</span>';
                echo '<span class="record"> : ' . $row->alternative. '</span>';
                echo '</td></tr>';
            }
            /*         * ********CONTRIBUTOR = CONTRIBUTEUR************* */
            if ($row->contributor && $this->params->get('contributeur') == '0') {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_CONTRIBUTOR') . '</span>';
                $contributor = str_ireplace("\r", "", $row->contributor);
                echo '<span class="record"> : ' . $contributor . '</span>';
                echo '</td></tr>';
            }
            /*         * ********rightsHolder = INTERPRETE************* */
            if (isset($row->rightsHolder)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_INTERPRETE') . '</span>';
                echo '<span class="record"> : ' . $row->rightsHolder. '</span>';
                echo '</td></tr>';
            }
            /*         * ********hasPart = PARTICIPANT************* OK */
            if (isset($row->hasPart)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_PARTICIPANT') . '</span>';
                echo '<span class="record"> : ' . str_ireplace("\r", "", $row->hasPart) . '</span>';
                echo '</td></tr>';
            } 
            /*         * ********mediator = PRODUCTEUR************* OK */
            if (isset($row->mediator)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_PRODUCTEUR') . '</span>';
                echo '<span class="record"> : ' . $row->mediator . '</span>';
                echo '</td></tr>';
            }
            /*         * ********DESCRIPTION = DESCRIPTION************* */
            /*if ($row->description && $this->params->get('description') == '0') {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_DESCRIPTION') . '</span>';
                $description = str_ireplace("\r", "", $row->description);
                echo '<span class="record"> : ' . $description . '</span>';
                echo '</td></tr>';
            }*/
            /*fin table1*/
            echo '</table>';  
	
        /*FIN  DIV tab 1*/
        echo '</div>';
        
        echo '<div class="divtab2">';
/*********************************TABLE 3***********************************************************/

        echo '<table class="notice2 tab3">';
            /*         * ********license = EDITEURPUBLI************* OK */
            if (isset($row->license)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_EDITEURPUBLI') . '</span>';
                echo '<span class="record"> : ' . $row->license . '</span>';
                echo '</td></tr>';
            }
            /*         * ********DATE = DATEPUBLI************* */
            if ($row->date && $this->params->get('date') == '0') {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_DATEPUBLI') . '</span>';
                echo '<span class="record"> : ' . $row->date . '</span>';
                echo '</td></tr>';
            }
            /*         * ********SPATIAL = LIEUPUBLI************* */
            if ($row->coverage && $this->params->get('spatial') == '0') {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_COVERAGE') . '</span>';
                echo '<span class="record"> : ' . $row->coverage . '</span>';
                echo '</td></tr>';
            }
            /*         * ********extent = COLLECTION************* OK */
            if (isset($row->extent)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_COLLECTION') . '</span>';
                echo '<span class="record"> : ' . $row->extent . '</span>';
                echo '</td></tr>';
            }
        /*         * ********modified = LIEN_COLLECTION************* OK */
        if (isset($row->valid)) {
            echo '<tr>';
            echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_LIEN_COLLECTION') . '</span>';
            echo '<span class="record"> : ' . $row->valid . '</span>';
            echo '</td></tr>';
        }  
      /*FIN TABLE 3*/
        echo '</table>';  
  //***************************TABLE 4 ****************************************************/   
         echo '<table class="notice2 tab4" >';
            /*         * ********created = DISTRIBMUSICALE************* OK */
            if (isset($row->created)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_DISTRIBMUSICALE') . '</span>';
                echo '<span class="record"> : ' . $row->created . '</span>';
                echo '</td></tr>';
            }
            /*         * ********accrualPolicy = DESCRIPTMUSICALE************* OK */
            if (isset($row->accrualPolicy)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_DESCRIPTMUSICALE') . '</span>';
                echo '<span class="record"> : ' . $row->accrualPolicy . '</span>';
                echo '</td></tr>';
            }
            /*         * ********instructionalMethod = DESCRIPTMATERIELLE************* OK */
            if (isset($row->instructionalMethod)) {
                echo '<tr>';
                echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_DESCRIPTMATERIELLE') . '</span>';
                echo '<span class="record"> : ' . $row->instructionalMethod . '</span>';
                echo '</td></tr>';
            }
        /*         * ********conformsTo = IDENTIF_COMMERCE************* OK */
        if (isset($row->conformsTo)) {
            echo '<tr>';
            echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_IDENTIF_COMMERCE') . '</span>';
            echo '<span class="record"> : ' . $row->conformsTo . '</span>';
            echo '</td></tr>';
        }
         /*         * ********spacial = DISTRIBUTEUR************* OK */
        if (isset($row->spatial)) {
            echo '<tr>';
            echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_DISTRIBUTEUR') . '</span>';
            echo '<span class="record"> : ' . $row->spatial . '</span>';
            echo '</td></tr>';
        }
                
        echo '</table>';
        echo '</div>';
        /*         * ********IDENTIFIER************* */
        if ($row->identifier && $this->params->get('identifieur') == '0') {
            echo '<div id="mev">';
            echo '<div class="link">';
            //echo JText::_('COM_L21OAI25_IDENTIFIEUR');
            // On récupère les enregistrement de la BDD du champ 'identifier'. On supprime les ';' pour enregistrer les résultats dans le tableau iden
            $iden = explode(";", $row->identifier);
            for ($j = 0; $j < sizeof($iden); $j++) {
                // supprime les caractère invisible en début et fin de la chaine $iden[$j]
                $chaine = trim($iden[$j]);
                // Si les 7 premier caractère de la chaine son 'http://'
                if (substr($chaine, 0, 7) == "http://") {
                    // strlen retourne le nombre de caractère de la chaine de caractère
                    $end = strlen($chaine);
                    // soustrait 3 au nombres de caractère compté précédemment
                    $start = $end - 3;
                    // si les 3 derniers caractères de la variable chaine son 'pdf' on affiche le lien de téléchargement
                    if (substr($chaine, $start, $end) == "pdf") {
                        echo '<span class="record"> : ' . ("<a  href=\"" . $chaine . "\">  Télécharger le pdf  </a>") . '</span>';
                    }
                    else {
                        // on envoie sur la page de l'entrepot original
                        echo '<span class="record">' . ("<a  href=\"" . $chaine . "\" target=_blank>  ".JText::_('COM_L21OAI25_ORIGINAL_LINK')."  </a>") . '</span>';
                    }
                } else {
                    // on affiche l'enregistrement de la BDD
                    echo '<span class="record"> : ' . ($chaine) . '</span>';
                }
            }
            echo '</div>';
            /*         * ********isReferencedBy = IDENTIF_RELATION*************  */
            if (isset($row->isReferencedBy)) {
                echo '<div class="link_doc">';
                //echo '<td><span class="notice_title">' . JText::_('COM_L21OAI25_IDENTIF_RELATION') . '</span>';
                echo '<a href="'.$row->isReferencedBy.'" target="_blank">' . JText::_('COM_L21OAI25_ORIGINAL_DOC') . '</a>';
                echo '</div>';
            }   
            echo '</div>';
        }
/*********************************FIN TABLE 2*******************************************************/
    }//END OF FOREACH
    ?>
</div>
<p class="readon" style="width:100%; display:block;">
    <a class="button button_noshadow" href="javascript:history.back()"><?php echo JText::_('COM_L21OAI25_RETURN') ?></a>
    <a class="button button_noshadow" style="float:right;" href="/index.php/ressources-numeriques/catalogue"><?php echo JText::_('COM_L21OAI25_NEW_SEARCH') ?></a>
</p>