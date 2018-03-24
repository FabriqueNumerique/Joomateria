<?php
// no direct access
	defined('_JEXEC') or die('Restricted access');
?>
<?php
	// Choisir quel type d'image afficher
	function gere_type($img, $multi=0){
		// Si option multi, c'est une collection multimédia, sinon elle est spécialisée
		if($multi != 0){
			return 'multi';
		}else{
			$img = strtolower($img);
			if(strstr($img,'image')){
				return 'image';
			}else if(strstr($img,'264')){
				return 'video';
			}else if(strstr($img,'pdf')){
				return 'texte';
			}else if(strstr($img,'audio')){
				return 'audio';
			}else if(strstr($img,'mp3')){
				return 'audio';
			}else if(strstr($img,'video')){
				return 'video';
			}else{
				return 'multi';
			};
		}
	}
	
	// Gérer les variables supplémentaires
	function set_variables($str){
		$champs_str = str_replace( ["\n", "\r"] , "&" , $str);
		
		$vars = array();
		parse_str($champs_str, $vars);
		
		return $vars;
	}
	///
	function traite_tableau($str){
		preg_match_all( '#isVersionOf=([0-9]*)&#U', $champs_str, $tab );
		return $tab;
	}
	// Récupérer les variables numériques du champ champs de la BDD
	function get_tableau($str){
		$champs_str = str_replace( ["\n", "\r"] , "§" , $str);
		
		$vals = explode('§', $champs_str);
		// echo $this->item->Format;
		return filtre($vals);
	}
	// FILTRER LES VALEURS POUR CREER DES TABLEAUX POUR LES SEQUENCAGES DES PLAYERS
	function filtre($tab, $duree='44100'){
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
				// Test pour vérifier la présence d'une chaine de caractères dans la variable qui définit le numéro des séquences
				// if(intval(substr($v, 10, strlen($v))) != 0){
					array_push($num, substr($v, 9, strlen($v)));
				/*}else{
					array_push($num, substr($v, 14, strlen($v)));
				}*/
			}else if(strpos($v, 'isReplacedBy') !== false){
				// Le texte lié à la séquence - intègre les liens pour une synchro avec des documents
				array_push($descr, substr($v, 13, strlen($v)));
			};
		}
		$sequences = array(
			'sequence' => $seq,
			'duree' => $duree,
			'num' => $num,
			'descr' => $descr
		);
		return $sequences;
	}
	// Milliseconds vers heure avec récupération de l'encodage audio (fréquence) et vidéo (images par seconde)
	function get_temps($milli, $duree='44100')
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
	function identifiant_lien($str){
		$liens = array();
		$str = str_replace( "\n" , '|' , $str);
		$liens = explode('|', $str);
		if(count($liens) < 2){
			array_unshift ( $liens , 0 );
		}
		return $liens;
	}
	
	// Reduire la taille d'un texte à un certain nombre de caractères
	function set_texte($chaine,$max=400) {  
		if(strlen($chaine)>=$max){ 
		   $chaine=substr($chaine,0,$max);  
		   $espace=strrpos($chaine," ");  
		   $chaine=substr($chaine,0,$espace)."...";  
		}  
		return $chaine; 
	}
	
	// Trier les liens externes pour afficher des pictos dans les collections : media pour trier s'il s'agit d'un média (image, audio, video, pdf)
	function tri_liens($liens, $media) { 
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
			break;
		} else{
			echo "<a href=".$liens." rel='lightbox'/>";
		}
	}
	
	// Afficher une liste déroulante des médias liés à une sére d'images
	function tri_liens_liste($liens, $media) {
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

	// Vérifier qu'il s'agit d'un lien http complet
	function verif_http($lien){
		if(substr($lien, 0, 4) != 'http'){
			$lien = 'http://'.$lien;
			return $lien;
		}
	}

	// Identifer la présence de PDF
	function test_pdf($lien){
		$pdf = strripos($lien, ".pdf");
		$txt = strripos($lien, ".doc");
		if ($pdf !== false || $txt !== false) { // note : 3 signes "="
			return "rel='lightbox'";
		}
	}

?>