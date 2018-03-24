<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.html');
JLoader::register('FinderHelperLanguage', JPATH_ADMINISTRATOR . '/components/com_finder/helpers/language.php');
FinderHelperLanguage::loadPluginLanguage();
$document = & JFactory::getDocument();
foreach ($this->notice as $row) {
    $document->setMetaData('keywords', $row->metadata);
}
?>
<div id="notice2" style="color:#000;">

    <?php
    foreach ($this->notice as $row) {
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
        $row->champs = stripcslashes($row->champs);
        $row->coverage = stripcslashes($row->coverage);

        if ($row->relation === NULL) {
            $img = "/images/stories/articles.jpg";
        }
        else
        {
            $sub = "vignette : "; //a recuperer dans le fichier de conf !!
            $img = strstr($row->relation, $sub);
            $img = str_replace($sub, "", $img);
        }
        //Affichage des informations de la notice suivant les enregistrement dans la BDD
        /*         * ********TITLE************* */
        if ($this->params->get('titre') == '0') {
			echo '<div class="module-title-surround"><div class="module-title">';
		
            echo '<h2 class="title">';
            $title = str_ireplace("\r", "<br />", $row->title);
            echo $title;
            echo '</h2>';
			 if ($this->params->get('Facebook') == '0') {
            echo '<p id="reseauxFb">
           <a name="fb_partager" title="partager sur Facebook"></a></p>';
        }
        if ($this->params->get('Twiter') == '0') {
            echo '<p id="reseauxTwit">
           <a href="http://twitter.com/share" title="partager sur Twiter" class="twitter-share-button">Tweet</a></p>';
        }
			echo '</div></div>';
			
			 if ($row->local_link && $this->params->get('locallink') == '0') {
			
           
			 echo '<div id="player">';
			echo '<span class="notice_title2">' . Jtext::_('COM_L21OAI25_EXTRAIT') . '</span>';
            echo '' . $row->local_link . '';
            echo '</div>';
			
			 }
			 /*         * ********MINIATURE************* */
			  $miniature = "images/exlineo/medias/" . $row->id_store . "/" . $row->id_record . "_thumb.jpg";
        $image = "images/exlineo/medias/" . $row->id_store . "/" . $row->id_record . ".jpg";
        if ($this->params->get('miniature') == '0') {
			echo '<div id="thumb">';
			 if (!file_exists($miniature)) {
                $miniature = "images/exlineo/medias/articles.jpg";
                echo '<div id="content">';
                echo '<a href="' . ($chaine) . '"  >';
                echo '<img alt="' . $row->title . '" src="' . $miniature . '" title="' . $row->title . '" style="border: thin dotted #6B0707;" width="150"/>';
                echo '</a>';
                echo '</div>';
            } else {
                echo '<div id="content">';
                echo '<a href="' . $image . '" class="jqzoom" style="" title="' . $row->title . '" >';
                echo '<img alt="' . $row->title . '" src="' . $miniature . '" title="' . $row->title . '" style="border: thin dotted #6B0707;" whidth="150"/>';
                echo '</a>';
                echo '</div>';
            }
			echo '</div>';
			 }
			 
			  /*         * ********LOCAL_LINK************* */
       /* if ($row->local_link && $this->params->get('locallink') == '0') {
            echo '<div id="player">';
			echo '<span class="notice_title">' . Jtext::_('COM_L21OAI25_EXTRAIT') . '</span>';
            echo '' . $row->local_link . '';
            echo '</div>';
        }*/
            echo '<table class="notice2" style="color:#000;">';
        }
        /*         * ********RESEAUX SOCIAUX************* */
       // if ($this->params->get('Facebook') == '0') {
//            echo '<p id="reseauxFb">
//           <a name="fb_partager" title="partager sur Facebook"></a></p>';
//        }
//        if ($this->params->get('Twiter') == '0') {
//            echo '<p id="reseauxTwit">
//           <a href="http://twitter.com/share" title="partager sur Twiter" class="twitter-share-button">Tweet</a></p>';
//        }
        /*         * ********CREATOR************* */
		/* if ($row->local_link && $this->params->get('locallink') == '0') {
			 echo '<tr>';
            echo '<td colspan="3">';
			 echo '<div id="player">';
			echo '<span class="notice_title2">' . Jtext::_('COM_L21OAI25_EXTRAIT') . '</span>';
            echo '' . $row->local_link . '';
            echo '</div>';
			echo '</td>';
			 }*/
		 if ($row->title && $this->params->get('titre') == '0') {
            echo '<tr>';
            echo '<td class="notice_title">' . JText::_('TITRE') . '</td>';
            $titre = str_ireplace("\r", "<br />", $row->title);
            echo '<td class="notice_inter">: </td><td class="record">' . $titre . '</td>';
            echo '</tr>';
        }	 
        if ($row->creator && $this->params->get('createur') == '0') {
            echo '<tr>';
            echo '<td class="notice_title">' . JText::_('COM_L21OAI25_CREATOR') . '</td>';
            $creator = str_ireplace("\r", "<br />", $row->creator);
            echo '<td class="notice_inter">: </td><td class="record">' . $creator . '</td>';
            echo '</tr>';
        }
		
        /*         * ********CONTRIBUTOR************* */
        if ($row->contributor && $this->params->get('contributeur') == '0') {
            echo '<tr>';
            echo '<td class="notice_title">' . JText::_('COM_L21OAI25_CONTRIBUTOR') . '</td>';
            $contributor = str_ireplace("\r", "<br />", $row->contributor);
            echo '<td class="notice_inter">: </td><td class="record">' . $contributor . '</td>';
            echo '</tr>';
        }
        /*         * ********DATE************* */
        if ($row->date && $this->params->get('date') == '0') {
            echo '<tr>';
            echo '<td class="notice_title">' . JText::_('COM_L21OAI25_DATE') . '</td>';
            echo '<td class="notice_inter">: </td><td class="record">' . $row->date . '</td>';
            echo '</tr>';
        }
        /*         * ********IDENTIFIER************* */
        if ($row->identifier && $this->params->get('identifieur') == '0') {
            echo '<tr>';
            echo '<td class="notice_title">' . JText::_('COM_L21OAI25_IDENTIFIEUR') . '</td>';
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
                        echo '<td class="notice_inter">: </td><td class="record">' . ("<a  href=\"" . $chaine . "\">  Télécharger le pdf  </a>") . '</td>';
                    }
                    // sinon
                    else {
                        // on envoie sur la page de l'entrepot original
                        echo '<td class="notice_inter">: </td><td class="record">' . ("<a  href=\"" . $chaine . "\" target=_blank>  Lien vers l'original  </a>") . '</td>';
                    }
                } else {
                    // on affiche l'enregistrement de la BDD
                    echo '<td class="notice_inter">: </td><td class="record">' . ($chaine) . '</td>';
                }
            }
            echo '</tr>';
        }
        /*         * ********SUBJECT************* */
        if ($row->subject && $this->params->get('sujets') == '0') {
            echo '<tr>';
            echo'<td class="notice_title">' . JText::_('COM_L21OAI25_SUBJECT') . '</td>';
            $sub = str_ireplace("\r", "<br />", $row->subject);
            echo '<td class="notice_inter">: </td><td class="record">' . $sub . '</td>';
            echo '</tr>';
        }
        /*         * ********DESCRIPTION************* */
        if ($row->description && $this->params->get('description') == '0') {
            echo '<tr>';
            echo '<td class="notice_title">' . JText::_('COM_L21OAI25_DESCRIPTION') . '</td>';
            $description = str_ireplace("\r", "<br />", $row->description);
            echo '<td class="notice_inter">: </td><td class="record">' . $description . '</td>';
            echo '</tr>';
        }
        /*         * ********FORMAT************* */
        if ($row->format && $this->params->get('format') == '0') {
            echo '<tr>';
            echo '<td class="notice_title">' . JText::_('COM_L21OAI25_FORMAT') . ' : </strong><br />';
            $format = str_ireplace("\r", "<br />", $row->format);
            echo '<td class="notice_inter">: </td><td class="record">' . $format . '</td>';
            echo '</tr>';
        }
        /*         * ********TYPE************* */
        if ($row->type && $this->params->get('type') == '0') {
            echo '<tr>';
            echo '<td class="notice_title">' . JText::_('COM_L21OAI25_TYPE') . '</td>';
            $type = str_ireplace("\r", "<br />", $row->type);
            echo '<td class="notice_inter">: </td><td class="record">' . $type . '</td>';
            echo '</tr>';
        }
        /*         * ********LANGUAGE************* */
        if ($row->language && $this->params->get('langage') == '0') {
            echo '<tr>';
            echo '<td class="notice_language"><strong>'  . JText::_('COM_L21OAI25_LANGAGE') . ' : </strong></td>';
            $language = str_ireplace("\r", "<br />", $row->language);
            echo '<td class="notice_inter">: </td><td class="record">' . $language . '</td>';
            echo '</tr>';
        }
        /*         * ********RELATION************* */
        if ($row->relation && $this->params->get('relation') == '0') {
            echo '<tr>';
            echo '<td class="notice_title">'  . JText::_('COM_L21OAI25_RELATION') . ' : </strong></td>';
            echo '<td class="notice_inter">: </td><td class="record"><a  href="' . $row->relation . '" target=_blank>  Lien l\'entrepot d\'origine  </a></td>';
        }
        /*         * ********PUBLISHER************* */
        if ($row->publisher && $this->params->get('editeur') == '0') {
            echo '<tr>';
            echo '<td class="notice_title">' . JText::_('COM_L21OAI25_EDITOR') . '</td>';
            $publisher = str_ireplace("\r", "<br />", $row->publisher);
            echo '<td class="notice_inter">: </td><td class="record">' . $publisher . '</td>';
            echo '</tr>';
        }
        /*         * ********CHAMPS************* */
        if ($row->champs && $this->params->get('champsnondc') == '0') {
            $champs = explode(chr(13).chr(10), $row->champs);
			
            foreach ($champs as $champ) {
                $dec = explode("=", $champ);
                if (array_key_exists(1, $dec) && $dec[1] != NULL) {
                    echo '<tr>';
                    echo '<td class="notice_title">' .  JText::_(JText::_(FinderHelperLanguage::branchSingular($dec[0]))). '</td>';
                    echo '<td class="notice_inter">: </td><td class="record">' . $dec[1] . '</td>';
                    echo '</tr>';
                }
            }
        }
        /*         * ********MINIATURE************* */
       // $miniature = "images/exlineo/medias/" . $row->id_store . "/" . $row->id_record . "_thumb.jpg";
//        $image = "images/exlineo/medias/" . $row->id_store . "/" . $row->id_record . ".jpg";
//        if ($this->params->get('miniature') == '0') {
//            echo '<tr rowspan="3"><td>';
//            if (!file_exists($miniature)) {
//                $miniature = "images/exlineo/medias/articles.jpg";
//                echo '<div id="content">';
//                echo '<a href="' . ($chaine) . '"  >';
//                echo '<img alt="' . $row->title . '" src="' . $miniature . '" title="' . $row->title . '" style="border: 1px solid #666;" width="150"/>';
//                echo '</a>';
//                echo '</div>';
//            } else {
//                echo '<div id="content">';
//                echo '<a href="' . $image . '" class="jqzoom" style="" title="' . $row->title . '" >';
//                echo '<img alt="' . $row->title . '" src="' . $miniature . '" title="' . $row->title . '" style="border: 1px solid #666;"/>';
//                echo '</a>';
//                echo '</div>';
//            }
//            echo '</td></tr>';
//        }
        /*         * ********RIGHTS************* */
        if ($row->rights && $this->params->get('droit') == '0') {
            echo '<tr>';
            echo '<td class="notice_title">' . JText::_('COM_L21OAI25_RIGHTS') . '</td>';
            $rights = str_ireplace("\r", "<br />", $row->rights);
            echo '<td class="notice_inter">: </td><td class="record">' . $rights . '</td>';
            echo '</tr>';
        }
        /*         * ********SOURCE************* */
        if ($row->source && $this->params->get('source') == '0') {
            echo '<tr>';
            echo '<td class="notice_title">' . JText::_('COM_L21OAI25_SOURCE') . '</td>';
            $source = str_ireplace("\r", "<br />", $row->source);
            echo '<td class="notice_inter">: </td><td class="record">' . $source . '</td>';
            echo '</tr>';
        }
        /*         * ********DATESTAMP************* */
        if ($row->datestamp && $this->params->get('datestamp') == '0') {
            echo '<tr>';
            echo '<td class="notice_title">' . JText::_('COM_L21OAI25_MAJ') . '</td>';
            $datestamp = str_ireplace("\r", "<br />", $row->datestamp);
            echo '<td class="notice_inter">: </td><td class="record">' . JHTML::Date($datestamp) . '</td>';
            echo '</tr>';
        }
       // /*         * ********LOCAL_LINK************* */
//        if ($row->local_link && $this->params->get('locallink') == '0') {
//            echo '<tr>';
//            echo '<td colspan="3" class="record">' . $row->local_link . '</td>';
//            echo '</tr>';
//        }
        /*         * ********SPATIAL************* */
        if ($row->coverage && $this->params->get('spatial') == '0') {
            echo '<tr>';
            echo '<td class="notice_title">' . JText::_('COM_L21OAI25_COVERAGE') . '</td>';
            echo '<td class="notice_inter">: </td><td class="record">' . $row->coverage . '</td>';
            echo '</tr>';
        }
        /*         * ********CAT************* */
//$link = 'index.php?option='.$option.'&task=viewCat&id='.$row->id_oai_set;
//Utilisation d'une fonction PHP afin de retourner à la page précédente si le lien est cliqué
        /*         * ********BTN_RETURN************* */
        echo '<tr colspan="3"><td class="readon"><a class="button" href="javascript:history.back()">' . JText::_('COM_L21OAI25_RETURN') . '</a></td></tr>';
        echo '</table>';
    }//END OF FOREACH
    ?>
</div>