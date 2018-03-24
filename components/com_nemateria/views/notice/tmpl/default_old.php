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
<div id="notice" style="padding-bottom:15px;">
    
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
       // if ($this->params->get('titre') == '0') {
//            echo '<h2>';
//            $title = str_ireplace("\r", "<br />", $row->title);
//            echo $title;
//            echo '</h2>';
   //         echo '<table class="notice">';
//        }
//        /*         * ********RESEAUX SOCIAUX************* */
//        if ($this->params->get('Facebook') == '0') {
//            echo '<p id="reseauxFb">
//           <a name="fb_partager" title="partager sur Facebook"></a></p>';
//        }
//        if ($this->params->get('Twiter') == '0') {
//            echo '<p id="reseauxTwit">
//           <a href="http://twitter.com/share" title="partager sur Twiter" class="twitter-share-button">Tweet</a></p>';
//        }
//        /*         * ********CREATOR************* */
//        if ($row->creator && $this->params->get('createur') == '0') {
//            echo '<tr>';
//            echo '<td class="notice_title"><strong>' . JText::_('COM_L21OAI25_CREATOR') . '</strong></td>';
//            $creator = str_ireplace("\r", "<br />", $row->creator);
//            echo '<td class="notice_inter">: </td><td class="record">' . $creator . '</td>';
//            echo '</tr>';
//        }
//        /*         * ********CONTRIBUTOR************* */
//        if ($row->contributor && $this->params->get('contributeur') == '0') {
//            echo '<tr>';
//            echo '<td class="notice_title"><strong>' . JText::_('COM_L21OAI25_CONTRIBUTOR') . '</strong></td>';
//            $contributor = str_ireplace("\r", "<br />", $row->contributor);
//            echo '<td class="notice_inter">: </td><td class="record">' . $contributor . '</td>';
//            echo '</tr>';
//        }
//        /*         * ********DATE************* */
//        if ($row->date && $this->params->get('date') == '0') {
//            echo '<tr>';
//            echo '<td class="notice_title"><strong>' . JText::_('COM_L21OAI25_DATE') . '</strong></td>';
//            echo '<td class="notice_inter">: </td><td class="record">' . $row->date . '</td>';
//            echo '</tr>';
//        }
//        /*         * ********IDENTIFIER************* */
//        if ($row->identifier && $this->params->get('identifieur') == '0') {
//            echo '<tr>';
//            echo '<td class="notice_title"><strong>' . JText::_('COM_L21OAI25_IDENTIFIEUR') . '</strong></td>';
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
//                        echo '<td class="notice_inter">: </td><td class="record">' . ("<a  href=\"" . $chaine . "\">  Télécharger le pdf  </a>") . '</td>';
//                    }
//                    // sinon
//                    else {
//                        // on envoie sur la page de l'entrepot original
//                        echo '<td class="notice_inter">: </td><td class="record">' . ("<a  href=\"" . $chaine . "\" target=_blank>  Lien vers l'original  </a>") . '</td>';
//                    }
//                } else {
//                    // on affiche l'enregistrement de la BDD
//                    echo '<td class="notice_inter">: </td><td class="record">' . ($chaine) . '</td>';
//                }
//            }
//            echo '</tr>';
//        }
//        /*         * ********SUBJECT************* */
//        if ($row->subject && $this->params->get('sujets') == '0') {
//            echo '<tr>';
//            echo'<td class="notice_title"><strong>' . JText::_('COM_L21OAI25_SUBJECT') . '</strong></td>';
//            $sub = str_ireplace("\r", "<br />", $row->subject);
//            echo '<td class="notice_inter">: </td><td class="record">' . $sub . '</td>';
//            echo '</tr>';
//        }
//        /*         * ********DESCRIPTION************* */
//        if ($row->description && $this->params->get('description') == '0') {
//            echo '<tr>';
//            echo '<td class="notice_title"><strong>' . JText::_('COM_L21OAI25_DESCRIPTION') . '</strong></td>';
//            $description = str_ireplace("\r", "<br />", $row->description);
//            echo '<td class="notice_inter">: </td><td class="record">' . $description . '</td>';
//            echo '</tr>';
//        }
//        /*         * ********FORMAT************* */
//        if ($row->format && $this->params->get('format') == '0') {
//            echo '<tr>';
//            echo '<td class="notice_format"><strong>' . JText::_('COM_L21OAI25_FORMAT') . ' : </strong><br />';
//            $format = str_ireplace("\r", "<br />", $row->format);
//            echo '<td class="notice_inter">: </td><td class="record">' . $format . '</td>';
//            echo '</tr>';
//        }
//        /*         * ********TYPE************* */
//        if ($row->type && $this->params->get('type') == '0') {
//            echo '<tr>';
//            echo '<td class="notice_title"><strong>' . JText::_('COM_L21OAI25_TYPE') . '</strong></td>';
//            $type = str_ireplace("\r", "<br />", $row->type);
//            echo '<td class="notice_inter">: </td><td class="record">' . $type . '</td>';
//            echo '</tr>';
//        }
//        /*         * ********LANGUAGE************* */
//        if ($row->language && $this->params->get('langage') == '0') {
//            echo '<tr>';
//            echo '<td class="notice_language"><strong>'  . JText::_('COM_L21OAI25_LANGAGE') . ' : </strong></td>';
//            $language = str_ireplace("\r", "<br />", $row->language);
//            echo '<td class="notice_inter">: </td><td class="record">' . $language . '</td>';
//            echo '</tr>';
//        }
//        /*         * ********RELATION************* */
//        if ($row->relation && $this->params->get('relation') == '0') {
//            echo '<tr>';
//            echo '<td class="notice_relation"><strong>'  . JText::_('COM_L21OAI25_RELATION') . ' : </strong></td>';
//            echo '<td class="notice_inter">: </td><td class="record"><a  href="' . $row->relation . '" target=_blank>  Lien l\'entrepot d\'origine  </a></td>';
//        }
//        /*         * ********PUBLISHER************* */
//        if ($row->publisher && $this->params->get('editeur') == '0') {
//            echo '<tr>';
//            echo '<td class="notice_title"><strong>' . JText::_('COM_L21OAI25_EDITOR') . '</strong></td>';
//            $publisher = str_ireplace("\r", "<br />", $row->publisher);
//            echo '<td class="notice_inter">: </td><td class="record">' . $publisher . '</td>';
//            echo '</tr>';
//        }
//        /*         * ********CHAMPS************* */
//        if ($row->champs && $this->params->get('champsnondc') == '0') {
//            $champs = explode(chr(13).chr(10), $row->champs);
//            foreach ($champs as $champ) {
//                $dec = explode("=", $champ);
//                if (array_key_exists(1, $dec) && $dec[1] != NULL) {
//                    echo '<tr>';
//                    echo '<td class="notice_title"><strong>' .  JText::_(JText::_(FinderHelperLanguage::branchSingular($dec[0]))). '</strong></td>';
//                    echo '<td class="notice_inter">: </td><td class="record">' . $dec[1] . '</td>';
//                    echo '</tr>';
//                }
//            }
//        }
//        /*         * ********MINIATURE************* */
//        $miniature = "images/exlineo/medias" . $row->id_store . "/" . $row->id_record . "_thumb.jpg";
//        $image = "images/exlineo/medias" . $row->id_store . "/" . $row->id_record . ".jpg";
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
//        /*         * ********RIGHTS************* */
//        if ($row->rights && $this->params->get('droit') == '0') {
//            echo '<tr>';
//            echo '<td class="notice_title"><strong>' . JText::_('COM_L21OAI25_RIGHTS') . '</strong></td>';
//            $rights = str_ireplace("\r", "<br />", $row->rights);
//            echo '<td class="notice_inter">: </td><td class="record">' . $rights . '</td>';
//            echo '</tr>';
//        }
//        /*         * ********SOURCE************* */
//        if ($row->source && $this->params->get('source') == '0') {
//            echo '<tr>';
//            echo '<td class="notice_title"><strong>' . JText::_('COM_L21OAI25_SOURCE') . '</strong></td>';
//            $source = str_ireplace("\r", "<br />", $row->source);
//            echo '<td class="notice_inter">: </td><td class="record">' . $source . '</td>';
//            echo '</tr>';
//        }
//        /*         * ********DATESTAMP************* */
//        if ($row->datestamp && $this->params->get('datestamp') == '0') {
//            echo '<tr>';
//            echo '<td class="notice_title"><strong>' . JText::_('COM_L21OAI25_MAJ') . '</strong></td>';
//            $datestamp = str_ireplace("\r", "<br />", $row->datestamp);
//            echo '<td class="notice_inter">: </td><td class="record">' . JHTML::Date($datestamp) . '</td>';
//            echo '</tr>';
//        }
//        /*         * ********LOCAL_LINK************* */
//        if ($row->local_link && $this->params->get('locallink') == '0') {
//            echo '<tr>';
//            echo '<td colspan="3" class="record">' . $row->local_link . '</td>';
//            echo '</tr>';
//        }
//        /*         * ********SPATIAL************* */
//        if ($row->coverage && $this->params->get('spatial') == '0') {
//            echo '<tr>';
//            echo '<td class="notice_title"><strong>' . JText::_('COM_L21OAI25_COVERAGE') . '</strong></td>';
//            echo '<td class="notice_inter">: </td><td class="record">' . $row->coverage . '</td>';
//            echo '</tr>';
//        }
//        /*         * ********CAT************* */
////$link = 'index.php?option='.$option.'&task=viewCat&id='.$row->id_oai_set;
////Utilisation d'une fonction PHP afin de retourner à la page précédente si le lien est cliqué
//        /*         * ********BTN_RETURN************* */
//        echo '<tr colspan="3"><td><a href="javascript:history.back()">' . JText::_('COM_L21OAI25_RETURN') . '</a></td></tr>';
//        echo '</table>';
  ?>
    <table width="100%" border="0" cellspacing="10" cellpadding="5">
      <tr>
        <td colspan="3"><?php  if ($this->params->get('titre') == '0') {
            echo '<h2>';
            $title = str_ireplace("\r", "<br />", $row->title);
            echo $title;
            echo '</h2>';
        } ?></td>
       
      </tr>
      <tr>
      <td colspan="3"><?php /*         * ********RESEAUX SOCIAUX************* */
        if ($this->params->get('Facebook') == '0') {
            echo '<p id="reseauxFb">
           <a name="fb_partager" title="partager sur Facebook"></a></p>';
        }
        if ($this->params->get('Twiter') == '0') {
            echo '<p id="reseauxTwit">
           <a href="http://twitter.com/share" title="partager sur Twiter" class="twitter-share-button">Tweet</a></p><br />';
        } ?></td>
      </tr>
      <tr>
      <td width="50%" valign="top"><?php /*         * ********MINIATURE************* */
        $miniature = "images/exlineo/medias" . $row->id_store . "/" . $row->id_record . "_thumb.jpg";
        $image = "images/exlineo/medias" . $row->id_store . "/" . $row->id_record . ".jpg";
        if ($this->params->get('miniature') == '0') {
            echo '<tr rowspan="3"><td>';
            if (!file_exists($miniature)) {
                $miniature = "images/exlineo/medias/articles.jpg";
				 echo '<a href="' . ($chaine) . '"  >';
                echo '<img alt="' . $row->title . '" src="' . $miniature . '" title="' . $row->title . '" style="border: 1px solid #666;" width="150"/>';
                echo '</a>';
				 } else {
                echo '<a href="' . $image . '" class="jqzoom" style="" title="' . $row->title . '" >';
                echo '<img alt="' . $row->title . '" src="' . $miniature . '" title="' . $row->title . '" style="border: 1px solid #666;"/>';
                echo '</a><br />';
            }
        } 
		
		?></td><td colspan="2" valign="top"><?php  if ($row->relation && $this->params->get('relation') == '0') {
            echo '<strong>'  . JText::_('COM_L21OAI25_RELATION') . ' : </strong><br/>';
				echo '<object id="myContentMP3" width="300" height="60" type="application/x-shockwave-flash" data="http://projet21.labxxi.com/components/com_exlineo/js/player.swf" style="visibility: visible;">
<param name="flashvars" value="file=http://projet21.labxxi.com/images/exlineo/medias/mp3/' . $row->relation . '">
<param name="allowFullScreen" value="true">
<param name="allowScriptAccess" value="always">
</object><br />';
        }
		
		
				?></td>
                
      
      </tr>
      <tr>
       
        <td valign="top"><?php
		
	  /*         * ********RIGHTS************* */
        if ($row->rights && $this->params->get('droit') == '0') {
			echo '<strong>' . JText::_('COM_L21OAI25_RIGHTS') . '</strong>';
			 $rights = str_ireplace("\r", "<br />", $row->rights);
            echo ' : '.$rights.'';
			 }
        /*         * ********SOURCE************* */
        if ($row->source && $this->params->get('source') == '0') {
          
            echo '<strong>' . JText::_('COM_L21OAI25_SOURCE') . '</strong>';
            $source = str_ireplace("\r", "<br />", $row->source);
            echo ' : '. $source . '' ; 
        }
		/*         * ********DATESTAMP************* */
        if ($row->datestamp && $this->params->get('datestamp') == '0') {
            echo '<strong>' . JText::_('COM_L21OAI25_MAJ') . '</strong>';
            $datestamp = str_ireplace("\r", "<br />", $row->datestamp);
            echo ' : ' . JHTML::Date($datestamp) . '';
        }
        /*         * ********LOCAL_LINK************* */
        if ($row->local_link && $this->params->get('locallink') == '0') {
            echo '  ' . $row->local_link . '';
        }
        /*         * ********SPATIAL************* */
        if ($row->coverage && $this->params->get('spatial') == '0') {
            echo '<strong>' . JText::_('COM_L21OAI25_COVERAGE') . '</strong>';
            echo ' : ' . $row->coverage . '<br />';
        }
			
		 /*         * ********TYPE************* */
        if ($row->type && $this->params->get('type') == '0') {
            echo '<strong>' . JText::_('COM_L21OAI25_TYPE') . '</strong>';
            $type = str_ireplace("\r", "<br />", $row->type);
            echo ' : ' . $type . '';
        }
        /*         * ********LANGUAGE************* */
        if ($row->language && $this->params->get('langage') == '0') {
            echo '<strong>'  . JText::_('COM_L21OAI25_LANGAGE') . ' : </strong>';
            $language = str_ireplace("\r", "<br />", $row->language);
            echo ' : ' . $language . '<br/>';
        }
      
        /*         * ********PUBLISHER************* */
        if ($row->publisher && $this->params->get('editeur') == '0') {
            echo '<strong>' . JText::_('COM_L21OAI25_EDITOR') . '</strong>';
            $publisher = str_ireplace("\r", "<br />", $row->publisher);
            echo ' : ' . $publisher . '';
        }	
		 
			
			
			  ?></td>
        <td valign="top"><?php  /*         * ********CREATOR************* */
        if ($row->creator && $this->params->get('createur') == '0') {
            echo '<strong>' . JText::_('COM_L21OAI25_CREATOR') . '</strong>';
            $creator = str_ireplace("\r", "<br />", $row->creator);
            echo ' : ' . $creator . '';
        }
        /*         * ********CONTRIBUTOR************* */
        if ($row->contributor && $this->params->get('contributeur') == '0') {
            echo '<strong>' . JText::_('COM_L21OAI25_CONTRIBUTOR') . '</strong>';
            $contributor = str_ireplace("\r", "<br />", $row->contributor);
            echo ' : ' . $contributor . '';
        }
        /*         * ********DATE************* */
        if ($row->date && $this->params->get('date') == '0') {
            echo '<strong>' . JText::_('COM_L21OAI25_DATE') . '</strong>';
            echo ' : ' . $row->date . '<br />';
        }
        /*         * ********IDENTIFIER************* */
        if ($row->identifier && $this->params->get('identifieur') == '0') {
            echo '<strong>' . JText::_('COM_L21OAI25_IDENTIFIEUR') . '</strong>';
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
                        echo ' : ' . ("<a  href=\"" . $chaine . "\">  Télécharger le pdf  </a>") . '';
                    }
                    // sinon
                    else {
                        // on envoie sur la page de l'entrepot original
                        echo ' : ' . ("<a  href=\"" . $chaine . "\" target=_blank>  Lien vers l'original  </a>") . '';
                    }
                } else {
                    // on affiche l'enregistrement de la BDD
                    echo ' : ' . ($chaine) . '<br />';
                }
            }
        }
        /*         * ********SUBJECT************* */
        if ($row->subject && $this->params->get('sujets') == '0') {
            echo'<strong>' . JText::_('COM_L21OAI25_SUBJECT') . '</strong>';
            $sub = str_ireplace("\r", "<br />", $row->subject);
            echo ' : ' . $sub . '';
        }
      
        /*         * ********FORMAT************* */
        if ($row->format && $this->params->get('format') == '0') {
            echo '<strong>' . JText::_('COM_L21OAI25_FORMAT') . ' : </strong>';
            $format = str_ireplace("\r", "<br />", $row->format);
            echo ' : ' . $format . '';
        } 
	
		
		
		?></td>
      </tr>
      <tr>
      <td colspan="3">
      <h3>Autres informations </h3>      
	  <?php 	/*         * ********CHAMPS************* */
        if ($row->champs && $this->params->get('champsnondc') == '0') {
            $champs = explode(chr(13).chr(10), $row->champs);
            foreach ($champs as $champ) {
                $dec = explode("=", $champ);
                if (array_key_exists(1, $dec) && $dec[1] != NULL) {
                    echo '<strong>' .  JText::_(JText::_(FinderHelperLanguage::branchSingular($dec[0]))). '</strong>';
                    echo ' : ' . $dec[1] . '<br/>';
                }
            }
        } ?></td></tr>
    </table>
  
    <?php   }//END OF FOREACH
    ?>
</div> 