<?php

defined('_JEXEC') or die('Restricted access');

jimport('joomla.html.html');

jimport( 'joomla.filesystem.file' );

JLoader::register('FinderHelperLanguage', JPATH_ADMINISTRATOR . '/components/com_finder/helpers/language.php');

FinderHelperLanguage::loadPluginLanguage();

$document = & JFactory::getDocument();

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

                        echo $row->title;

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

                $miniature = "images/nemateria/".$row->id_entrepot."/".$row->id_notice."_thumb.jpg";

                $image = "images/nemateria/".$row->id_entrepot."/".$row->id_notice.".jpg";

            if ($this->params->get('miniature') == '0') {

                echo '<div id="thumb">';

                if (!JFile::exists($miniature) && !JFile::exists($image)) {

                    $miniature = "images/nemateria/medias/articles.jpg";

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

            /*Player de musique rond ou player video*/

            if ($row->local_link && $this->params->get('locallink') == '0') {



                 echo '<input id="mymp3" type="hidden" value="'.$this->mp3.'" />';

                echo $this->player;	

	    }

            

            /*Fin div zone vignette*/

            echo '</div>';

            //Notice

            echo '<table class="notice_oai">';

            /*         * ********creator = AUTEUR************* */

            if ($row->creator && $this->params->get('createur') == '0') {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_CREATOR') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->creator . '</span></td></tr>';

            }

            /*         * ********DATE = DATEPUBLI************* */

            if ($row->date && $this->params->get('date') == '0') {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_DATEPUBLI') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->date . '</span></td></tr>';

            }

            /*         * ********RELATION************* */

            if ($row->relation && $this->params->get('relation') == '0') {

                echo '<tr><td class="notice_title"><span class="notice_title">'  . JText::_('COM_NEMATERIA_RELATION') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record"><a href="' . $row->relation . '" target=_blank>  Lien vers l\'entrepot d\'origine  </a></span></td></tr>';

            }

            /*         * ********SUBJECT = SUJET************* */

            if ($row->subject && $this->params->get('sujets') == '0') {

                echo'<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_SUBJECT') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->subject . '</span></td></tr>';

            }

            /*         * ********DESCRIPTION = DESCRIPTION************* */

            if ($row->description && $this->params->get('description') == '0') {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_DESCRIPTION') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->description . '</span></td></tr>';

            } 

            /*         * ********TYPE = TYPE DE DOCUMENT************* */

            if ($row->type && $this->params->get('type') == '0') {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_TYPE') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->type . '</span></td></tr>';

            }

            /*         * ********PUBLISHER = ETABLISSEMENT************* */

            if ($row->publisher && $this->params->get('editeur') == '0') {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_PUBLISHER') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->publisher . '</span></td></tr>';

            }

            //==============> ICI LES CHAMPS SPECIAUX

            /*         * ********METIER  ************* */

            if ($row->metier ) {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_METIER') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->metier . '</span></td></tr>';

            }

            /*         * ********ETABLISSEMENT  ************* */

            if ($row->etablissement ) {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_ETABLISSEMENT') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->etablissement . '</span></td></tr>';

            }

            /*         * ********CODE INSEE  ************* */

            if ($row->code_insee ) {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_CODEINSEE') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->code_insee . '</span></td></tr>';

            }

            //==============> ICI LES CHAMPS SPECIAUX

            /*         * ********RIGHTS = DROITS************* */

            if ($row->rights && $this->params->get('droit') == '0') {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_RIGHTS') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->rights . '</span></td></tr>';

            }

            /*         * ********SOURCE = LIEN INTERNET************* */

            if ($row->source && $this->params->get('source') == '0') {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_SOURCE') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->source . '</span></td></tr>';

            }

            /*         * ********DATESTAMP************* */

            if ($row->datestamp && $this->params->get('datestamp') == '0') {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_MAJ') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . JHTML::Date($row->datestamp) . '</span></td></tr>';

            }

            

            

            //Champ afficher ou pas ?

            

            

            /*         * ********LANGUAGE = LANGUE************* */

            if ($row->language && $this->params->get('langage') == '0') {

                echo '<tr><td class="notice_title"><span class="notice_title">'  . JText::_('COM_NEMATERIA_LANGAGE') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->language . '</span></td></tr>';

            }       

            

            /*         * ********CONTRIBUTOR = CONTRIBUTEUR************* */

            if ($row->contributor && $this->params->get('contributeur') == '0') {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_CONTRIBUTOR') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->contributor . '</span></td></tr>';

            }

            

            

            /*         * ********SPATIAL = LIEUPUBLI************* */

            if ($row->coverage && $this->params->get('spatial') == '0') {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_COVERAGE') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->coverage . '</span></td></tr>';

            }

            /*         * ********spacial = DISTRIBUTEUR************* OK */

            if (isset($row->spatial)) {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_DISTRIBUTEUR') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->spatial . '</span></td></tr>';

            }



            /*         * ********provenance = SOURCE_PUBLISHER************* OK */

            if (isset($row->provenance)) {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_SOURCE_PUBLISHER') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->provenance . '</span></td></tr>';

            }

            



                //        /*         * ********FORMAT************* */

            if ($row->format && $this->params->get('format') == '0') {

                echo '<tr><td class="notice_title"><span class="notice_title">' . JText::_('COM_NEMATERIA_FORMAT') . '</span></td>';

                echo '<td class="notice_inter"> : </td><td class="record"><span class="record">' . $row->format . '</span></td></tr>';

            }

        /*         * ********IDENTIFIER************* */

//        if ($row->identifier && $this->params->get('identifieur') == '0') {

//            //echo JText::_('COM_L21OAI25_IDENTIFIEUR');

//            // On récupère les enregistrement de la BDD du champ 'identifier'. On supprime les ';' pour enregistrer les résultats dans le tableau iden

//            $iden = explode(";", $row->identifier);

//            for ($j = 0; $j < sizeof($iden); $j++) {

//                // supprime les caractère invisible en début et fin de la chaine $iden[$j]

//                $chaine = trim($iden[$j]);

//                // Si les 7 premier caractère de la chaine son 'http://'

//                if (substr($chaine, 0, 7) == "http://") {

//                    // strlen retourne le nombre de caractère de la chaine de caractère

//                    $end = strlen($chaine);

//                    // soustrait 3 au nombres de caractère compté précédemment

//                    $start = $end - 3;

//                    // si les 3 derniers caractères de la variable chaine son 'pdf' on affiche le lien de téléchargement

//                    if (substr($chaine, $start, $end) == "pdf") {

//                        echo '<span class="record"> : ' . ("<a  href=\"" . $chaine . "\">  Télécharger le pdf  </a>") . '</span>';

//                    }

//                    else {

//                        // on envoie sur la page de l'entrepot original

//                        echo '<span class="record">' . ("<a  href=\"" . $chaine . "\" target=_blank>  ".JText::_('COM_L21OAI25_ORIGINAL_LINK')."  </a>") . '</span>';

//                    }

//                } else {

//                    // on affiche l'enregistrement de la BDD

//                    echo '<span class="record"> : ' . ($chaine) . '</span>';

//                }

//            }

//        }

        echo '</table>';

    }//END OF FOREACH

    ?>

</div>

<p class="readon" style="width:100%; display:block;">

    <a class="button button_noshadow" href="javascript:history.back()"><?php echo JText::_('COM_NEMATERIA_RETURN') ?></a>

    <a class="button button_noshadow" style="float:right;" href="index.php?option=com_nemateria&view=search"><?php echo JText::_('COM_NEMATERIA_NEW_SEARCH') ?></a>

</p>