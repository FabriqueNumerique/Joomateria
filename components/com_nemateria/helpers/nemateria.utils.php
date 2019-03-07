<?php
/**
 * Helper class for Nemateria utils
 * 
 * @package    Nemateria
 * @license        GNU/GPL, see LICENSE.php
 * Joomateria is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class NemateriaHelperUtils
{
    /**
     * Retrieves the hello message
     *
     * @param   string  $type a string to get media type from database
     *
     * @access public
     */    
    public static function types($type)
    {
        $type = strtolower($type);
			if(strstr($type,'image')){
				return 'image';
			}else if(strstr($type,'264')){
				return 'video';
			}else if(strstr($type,'pdf')){
				return 'texte';
			}else if(strstr($type,'audio')){
				return 'audio';
			}else if(strstr($type,'mp3')){
				return 'audio';
			}else if(strstr($type,'video')){
				return 'video';
			}else{
				return 'multi';
			};
    }
	
	// Gérer les variables supplémentaires
	public static function set_variables($str){
		$champs_str = str_replace( ["\n", "\r"] , "&" , $str);
		
		$vars = array();
		parse_str($champs_str, $vars);
		
		return $vars;
	}
	///
	public static function traite_tableau($str){
		preg_match_all( '#isVersionOf=([0-9]*)&#U', $champs_str, $tab );
		return $tab;
	}
	// Récupérer les variables numériques du champ champs de la BDD
	public static function get_tableau($str){
		$champs_str = str_replace( ["\n", "\r"] , "§" , $str);
		
		$vals = explode('§', $champs_str);
		// echo $this->item->Format;
		return NemateriaHelperUtils::filtre($vals);
	}
	// FILTRER LES VALEURS POUR CREER DES TABLEAUX POUR LES SEQUENCAGES DES PLAYERS
	public static function filtre($tab, $duree='44100'){
		
		$n = count($tab); // Longueur du tableau
		
		$sequences = array();
		
		$seq = array();
		$duree = array();
		$num = array();
		$descr = array();
		
		foreach($tab as $c=>$v){
			if(strpos($v, 'isVersionOf') !== false){
				// Le nombre de millisecondes de la séquence
				array_push($seq, substr($v, 12, strlen($v)));
				
			} else if(strpos($v, 'hasVersion') !== false){
				// La durée de la séquence
				array_push($duree, intval(substr($v, 11, strlen($v))));
				
			}else if(strpos($v, 'replaces') !== false){
				// Test pour vérifier la présence d'une chaine
				array_push($num, substr($v, 9, strlen($v)));
				
			}else if(strpos($v, 'isReplacedBy') !== false){
				// Le texte lié à la séquence - intègre les liens pour une synchro avec des documents
				array_push($descr, substr($v, 13, strlen($v)));
			};
		}
		
		array_pad( $duree, count($seq), 0 );
		array_pad( $num, count($seq), '' );
		array_pad( $descr, count($seq), '' );
		
		
		$sequences = array(
			'sequence' => $seq,
			'duree' => $duree,
			'num' => $num,
			'descr' => $descr
		);
		return $sequences;
	}
	// Milliseconds vers heure avec récupération de l'encodage audio (fréquence) et vidéo (images par seconde)
	public static function get_temps($milli, $duree='44100')
	{
		$secondes = intval($milli/$duree);
		/*** return value ***/
		$ret = "";
	
		/*** get the hours ***/
		$heure = intval(intval($secondes) / 3600);
		if($heure > 0)
		{
			$ret .= "$heure h ";
		}
		/*** get the minutes ***/
		$minutes = bcmod((intval($secondes) / 60),60);
		if($heure > 0 || $minutes > 0)
		{
			$ret .= "$minutes' ";
		}
	
		/*** get the seconds ***/
		$secondes = bcmod(intval($secondes),60);
		$ret .= "$secondes\" ";
	
		return $ret;
	}
	
	// Extraire le lien de la ressource
	public static function identifiant_lien($str){
		$liens = array();
		$str = str_replace( "\n" , '|' , $str);
		$liens = explode('|', $str);
		if(count($liens) < 2){
			array_unshift ( $liens , 0 );
		}
		return $liens;
	}
	
	// Reduire la taille d'un texte à un certain nombre de caractères
	public static function set_texte($chaine,$max=400) {  
		if(strlen($chaine)>=$max){ 
		   $chaine=substr($chaine,0,$max);  
		   $espace=strrpos($chaine," ");  
		   $chaine=substr($chaine,0,$espace)."...";  
		}  
		return $chaine; 
	}
	
	// Trier les liens externes pour afficher des pictos dans les collections : media pour trier s'il s'agit d'un média (image, audio, video, pdf)
	public static function tri_liens($liens, $media) { 
		if(strpos(":") !== false){
			// $liens = str_replace( "|" , "&" , $liens);
			$vars= explode("|", $liens);
			
			foreach($vars as $c => $v){
				$tmp_str = "";
				$tmp_ar = explode(":", $v);
				
				// $tmp_str .= "<a href='".$tmp_ar[1]."' rel='lightbox' target='_blank' title='".$tmp_ar[0]."'>";
				$tmp_str .= "<a href='".$tmp_ar[1]."' ".test_pdf($liens)." target='_blank' title='".$tmp_ar[0]."'>";
           		$tmp_str .= "<img src='".JURI::root()."images/icones/media_".$media."_mini.png' class='droite' />";
        		$tmp_str .= "</a>";
				
				echo $tmp_str;
			}
		} else{
			echo "<a href=".$liens." rel='lightbox'/>";
		}
	}
	
	// Afficher une liste déroulante des médias liés à une sére d'images
	public static function tri_liens_liste($liens, $media) {
		$tmp_str = "";
		$tmp_ar = [];
		// Vérifier s'il y a des liens avec un titre
		$tmp1 = strpos($liens, ":");
		// Vérifier s'il y a plusieurs liens
		$tmp2 = strpos($liens, "|");
		
		if($tmp1 !== false && $tmp2 !== false){
			$vars= explode("|", $liens);
			
			foreach($vars as $c => $v){
				$tmp_ar = explode(":", $v, 2);
				// $tmp_str = "<a href='".verif_http($tmp_ar[1])."' rel='lightbox' target='_blank' title='".$tmp_ar[0]."'>";
				$tmp_str = "<a href='".verif_http($tmp_ar[1])."' ".test_pdf($liens)." target='_blank' title='".$tmp_ar[0]."'>";
           		$tmp_str .= $tmp_ar[0]." (".$media.")";
        		$tmp_str .= "</a>";
				
				echo $tmp_str;
			}
			
		} else if ($tmp1 !== false && $tmp2 === false){
			$tmp_ar = explode(":", $liens, 2);
			// $tmp_str .= "<a href='".verif_http($tmp_ar[1])."' rel='lightbox' target='_blank' title='".$tmp_ar[0]."'>";
			$tmp_str .= "<a href='".verif_http($tmp_ar[1])."' ".test_pdf($liens)." target='_blank' title='".$tmp_ar[0]."'>";
           	$tmp_str .= $tmp_ar[0]." (".$media.")";
        	$tmp_str .= "</a>";
			
			echo $tmp_str;
		}else{
			// echo "<a href=".verif_http($liens)." rel='lightbox'>(".$media.")</a>";
			echo "<a href=".verif_http($liens)." ".test_pdf($liens)." >(".$media.")</a>";
		}
		 
	}
    // Identifier les séries et renvoyer une adresse avec une série ajoutée
    public static function setSerieUrl($url, $serie){
        $pos = strpos($url, '&serie');
        if($pos === false){
            return $url."&serie=".$serie;
        }else{
            return substr($url, 0, strpos($url, '&serie'))."&serie=".$serie;
        }
    }
    // Paramétrer la classe d'une série
    public static function setSerieClasse($actu, $serie){
        if($actu == $serie){
			return 'vert';
		}else{
			return 'rose';
		}
    }
	// Vérifier qu'il s'agit d'un lien http complet
	public static function verif_http($lien){
		if(substr($lien, 0, 4) != 'http'){
			$lien = 'http://'.$lien;
			return $lien;
		}
	}

	// Identifer la présence de PDF
	public static function test_pdf($lien){
		$pdf = strripos($lien, ".pdf");
		$txt = strripos($lien, ".doc");
		if ($pdf !== false || $txt !== false) { // note : 3 signes "="
			return "rel='lightbox'";
		}
	}

	// ENvoyer un email avec Joomla
	public static function envoieMail($data){
		$config = JFactory::getConfig();
		$sender = array( 
			$config->get( 'mailfrom' ),
			$config->get( 'fromname' ) 
		);

		$mailer->setSender($sender);

		$body   = "Une contribution a été envoyée sur une notice de collection :\n";
		$mailer->setSubject('Contribution sur une notice de collection');
		$mailer->setBody($body);

		$send = $mailer->Send();
		if ( $send !== true ) {
			echo true;
		} else {
			echo false;
		}
	}
}