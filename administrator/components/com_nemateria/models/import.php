<?php
/**
 * @version		
 * @package		
 * @subpackage	
 * @copyright	
 * @license		
 */
 /*Modif janv 20019*/

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

/**
 * Indexer model class for Finder.
 *
 * @package		JXtended.Finder
 * @subpackage	com_finder
 * @version		1.1
 stores > entrepots
 sets > collections
 records > notices
 */
class NemateriaModelImport extends JModelAdmin
{   
    
    public function getForm($data = array(), $loadData = true)
    {
    }
	
	public function _getImport($id_collection , $start, $end, $rT)
        {
            //On augmente le temps maximale des opérations et 
            set_time_limit(0);
            //On récupère le nom du fichier de confog dans la table store
            $db = JFactory::getDBO();
            $query = 'SELECT a.config FROM #__nemateria_entrepots AS a LEFT JOIN #__nemateria_collections AS b ON a.id_entrepot = b.id_entrepot WHERE b.id_collection='.$id_collection;
            $db->setQuery( $query );
            $config = $db->loadObject();
            $conf = $config->config;
            
            //On récupère le fichier de conf pour accéder à certaines variables
            include (JPATH_ADMINISTRATOR.'/components/com_nemateria/configuration/'.$conf);
            //On récupère les informations de l'entrepôt
            $db = JFactory::getDBO();
            $query = 'SELECT * FROM #__nemateria_entrepots AS a LEFT JOIN #__nemateria_collections AS b ON a.id_entrepot = b.id_entrepot WHERE b.id_collection='.$id_collection;

            $db->setQuery( $query );
            $set = $db->loadObject();
            $idset = $id_collection;
            $tab = array();
            $data = array();
            $res = array();
            $config = array();
            $rT_int = array();

            if ($rT == 0){
                $records_url = $set->url."?verb=ListRecords";
                if($set->spec != "")
                {
                    $records_url .= "&set=".$set->spec;
                }
                $records_url .= "&metadataPrefix=".$lrNamespace;
                if($start != null){
                    $t_start = array();
                    $t_start = explode('/', $start);
                    $start = $t_start[2].'-'.$t_start[1].'-'.$t_start[0];
                    $records_url .= "&from=".$start;
                }
                if($end != null){
                    $t_end = array();
                    $t_end = explode('/', $end);
                    $end = $t_end[2].'-'.$t_end[1].'-'.$t_end[0];
                    $records_url .= "&until=".$end;
                }
//                echo $records_url;
                $exept = array();
                try{
                    $records = file_get_contents($records_url);
                    if(!$records){
                       throw new Exception('<br >!!Impossible de récupérer la page xml. Le serveur OAI ne répond pas : '.$records_url.'!!<br />');
                    }
                    else{                       
                        $xml = new SimpleXmlElement($records);
                        $xml_error = $xml->error;//On vérifie que la balise error n'existe pas
                        if($xml_error){
                            throw new Exception('<br >!!Impossible de récupérer la page xml. Le serveur OAI répond : '.$xml_error.'!!<br />');
                        }
                        else{
                            //On va récupérer le resumption token dans un tableau pour le concaténer avec les résultats
                            if(!empty($xml->ListRecords->resumptionToken)){
                                $rT_int['resumptionToken'] = $xml->ListRecords->resumptionToken;
                            }
                            else{
                                $rT_int['resumptionToken'] = "end";
                            }
                            if($xml){
                                $data = $this->_readXML($xml,$idset,$conf);//On récupère les informations de la page xml en coure
                            }
                            $config['conf']= $conf;
                        }
                    }
                }
                catch(Exception $e){
                    $exept['xml_error'] = $e;
                }
                $res = array_merge($data, $rT_int, $exept, $config);
                return $res;
            }
            elseif($rT != null ){
                $records_url = $set->url."?verb=ListRecords";
                $records_url .= "&resumptionToken=".$rT;
//                echo $records_url;
                $exept = array();
                 try{
                    $records = file_get_contents($records_url);
                    if(!$records){
                       throw new Exception('<br/>Impossible de récupérer la page xml : '.$records_url.'<br/>');
                    }
                    else{
                        $xml = new SimpleXmlElement($records);
                        $xml_error = $xml->error;//On vérifie que la balise error n'existe pas
                        if($xml_error){
                            throw new Exception('<br >!!Impossible de récupérer la page xml. Le serveur OAI répond : '.$xml_error.'!!<br />');
                        }
                        else{
                            //On va récupérer le resumption token dans un tableau pour le concaténer avec les résultats
                            if(!empty($xml->ListRecords->resumptionToken)){
                                $rT_int['resumptionToken'] = $xml->ListRecords->resumptionToken;
                            }
                            else{
                                $rT_int['resumptionToken'] = "end";
                            }
                            if($xml){
                                $data = $this->_readXML($xml,$idset,$conf);//On récupère les informations de la page xml en cours
                            }
                            $config['conf']= $conf;
                        }
                    }
                }
                catch(Exception $e){
                    $exept['xml_error'] = $e;
                }
                $res = array_merge($data, $rT_int, $exept, $config);
                return $res;
            }
        }
            
        function _readXML($xml, $idset, $c)
            {           
//            /***************LISTRECORDS CONFIG LIST**************/
//              //1er boucle
//            $lrheadNamespace = "http://www.openarchives.org/OAI/2.0/";
//            $lrlistRecordsXpath = "//a:ListRecords/a:record/a:header";
//            $lridentifierXpath = "child::a:identifier";
//            $lrdatestampXpath = "child::a:datestamp";
//            $lrsetSpecXpath = "child::a:setSpec";            
//              //2em boucle
//            $lroaidcNamespace = "http://www.openarchives.org/OAI/2.0/oai_dc/";
//            $lrdcXpath = "//d:dc";
//            $lrdcNamespace = "http://purl.org/dc/elements/1.1/";
//            $lrtitleXpath = 'child::c:title';
//            $lrcreatorXpath = 'child::c:creator';
//            $lrsubjectXpath = 'child::c:subject';
//            $lrdescriptionXpath = 'child::c:description';
//            $lrpublisherXpath = 'child::c:publisher';
//            $lrcontributorXpath = 'child::c:contributor';
//            $lrdateXpath = 'child::c:date';
//            $lrtypeXpath = 'child::c:type';
//            $lrformatXpath = 'child::c:format';
//            $lrdcidentifierXpath = 'child::c:identifier';
//            $lrsourceXpath = 'child::c:source';
//            $lrlanguageXpath = 'child::c:language';
//            $lrrelationXpath = 'child::c:relation';
//            $lrcoverageXpath = 'child::c:coverage';
//            $lrrightsXpath = 'child::c:rights';
//            /*************************************************/   

             include (JPATH_ADMINISTRATOR.'/components/com_nemateria/configuration/'.$c);
                ////On instencie un espace de nom correspondant a la balise oai_dc:dc
                $xml->registerXPathNamespace('a', $lrheadNamespace);
                //on va mettre en place un tableau qui contiendra les données de chaque set par ligne
                $data = array();
                //on va chercher dans le xml les information non dc => setspec et setname
                $i=0;
                    $ListRecords = array();
                    $ListRecords = $xml->xpath($lrlistRecordsXpath);
                    
                    $int_identifier = "";
                    $int_datestamp = "";
                    $int_collectionspec = "";
                    $errors="";//initialisation de la variable contenant les erreurs  
                    //print_r($xml);
                foreach ($ListRecords as $it)
                {
                        $it->registerXPathNamespace('a', $lrheadNamespace);
                        
                        $datestamp = $it->xpath($lrdatestampXpath);
                            foreach ($datestamp as $dt)
                                {
                                    $int_datestamp .= $dt.';';
                                }
                        $data[$i]['datestamp' ] =substr($int_datestamp, 0, -1);
                        $int_datestamp = "";
                        
                        $identifier = $it->xpath($lridentifierXpath);
                            foreach ($identifier as $dt)
                                {
                                    $int_identifier .= $dt.';';
                                }
                        $data[$i]['unique_identifier' ] = substr($int_identifier, 0, -1);
                        $int_identifier = "";


                        $setSpec = $it->xpath($lrsetSpecXpath);
                            foreach ($setSpec as $ss)
                                {
                                    $db = JFactory::getDBO();
                                    $query = 'SELECT id_collection FROM #__nemateria_collections WHERE spec="'.$ss.'"';
                                    $db->setQuery( $query );
                                    $set = $db->loadObject();
                                    $int_collectionspec .= $set->id_collection.';';
                                }
                            if (empty($setSpec))
                                {
                                    $int_collectionspec .= $idset.';';
                                }
                        $data[$i]['setSpec' ] = substr($int_collectionspec, 0, -1);
                        $int_collectionspec = "";

                        $i++;
                }
                
                ////On instencie un espace de nom correspondant a la balise oai_dc:dc
                $xml->registerXPathNamespace('d', $lroaidcNamespace);
                //On instencie la node oai_dc:dc et tout ce qu'elle contient comme un nouveau document xml par xpath
                $oai = $xml->xpath($lrdcXpath);
                //On va maintenant récupérer les autres informations contenus dans oai_dc:dc
                $i=0;
                $int_title = "";
                $int_creator = "";
                $int_subject = "";
                $int_description = "";
                $int_publisher = "";
                $int_contributor="";
                $int_date="";
                $int_type = "";
                $int_format="";
                $int_dcidentifier="";
                $int_source="";
                $int_language="";
                $int_relation="";
                $int_coverage="";
                $int_rights="";
                $int_datestamp="";
                
                $int_spatial = "";
                
                
                foreach ($oai as $ot)
                {
                    //On instencie un espace de nom correspondant a la balise "$nom":dc
                    $ot->registerXPathNamespace('c', $lrdcNamespace);
                    //title => on récupère les nodes par oai_dc:dc
                    $title = $ot->xpath($lrtitleXpath);
                    //Si on a plusieurs title on les incrémentes et on les stoques dans une variable intermédiaire
                    foreach ($title as $ti){
                        $int_title .= $this->stringSpliter($ti.chr(13).chr(10));
                        $int_title = html_entity_decode($int_title);
                    }
                    //On entre la variable dans le tableau
//                    $data[$i]['title'] = addslashes(substr($int_title,0, -1));
                    $data[$i]['title'] = $int_title;
                    //on remet la variable intermédiaire a "null"
                    $int_title = "";
                    
                    //creator
                    $creator = $ot->xpath($lrcreatorXpath);
                    foreach ($creator as $cr){
                        $int_creator .= $this->stringSpliter($cr.chr(13).chr(10));
                        $int_creator = html_entity_decode($int_creator);                        
                    }
//                    $data[$i]['creator'] = addslashes(substr($int_creator,0, -1));
                    $data[$i]['creator'] = $int_creator;
                    $int_creator = "";
                    
                    //subject
                    $subject = $ot->xpath($lrsubjectXpath);
                    foreach ($subject as $sub){
                        $int_subject .= $this->stringSpliter($sub.chr(13).chr(10));
                        $int_subject = html_entity_decode($int_subject);
                    }
//                    $data[$i]['subject'] = addslashes(substr($int_subject,0, -1));
                    $data[$i]['subject'] = $int_subject;
                    $int_subject = "";

                    //description
                    $description = $ot->xpath($lrdescriptionXpath);
                    foreach ($description as $de){
                        $int_description .= $this->stringSpliter($de.chr(13).chr(10));
                        $int_description = html_entity_decode($int_description);
                    }
//                    $data[$i]['description'] = addslashes(substr($int_description,0, -1));
                    $data[$i]['description'] = $int_description;
                    $int_description = "";

                    //publisher
                    $publisher = $ot->xpath($lrpublisherXpath);
                    foreach ($publisher as $pub){
                        $int_publisher .= $this->stringSpliter($pub.chr(13).chr(10));
                        $int_publisher = html_entity_decode($int_publisher);
                        $int_publisher = str_ireplace('  ', '', $int_publisher);
                    }
//                    $data[$i]['publisher'] = addslashes(substr($int_publisher,0, -1));
                    $data[$i]['publisher'] = $int_publisher;
                    $int_publisher = "";
                    
                    //contributor
                    $contributor = $ot->xpath($lrcontributorXpath);
                    foreach ($contributor as $contr){
                        $int_contributor .= $this->stringSpliter($contr.chr(13).chr(10));
                        $int_contributor = html_entity_decode($int_contributor);
                    }
                    $data[$i]['contributor'] = $int_contributor;
//                    $data[$i]['contributor'] = addslashes(substr($int_contributor,0, -1));
                    $int_contributor = "";
                    
                    //date
                    $date = $ot->xpath($lrdateXpath);
                    foreach ($date as $da){
                        $int_date .= $this->stringSpliter($da.chr(13).chr(10));
                        $int_date = html_entity_decode($int_date);
                    }
//                    $data[$i]['date'] = addslashes(substr($int_date,0, -1));
                    $data[$i]['date'] = $int_date;
                    $int_date = "";

                    //type
                    $type = $ot->xpath($lrtypeXpath);
                    foreach ($type as $ty){
                        $int_type .= $this->stringSpliter($ty.chr(13).chr(10));
                        $int_type = html_entity_decode($int_type);
                    }
//                    $data[$i]['type'] = addslashes(substr($int_type,0, -1));
                    $data[$i]['type'] = $int_type;
                    $int_type = "";

                    //format
                    $format = $ot->xpath($lrformatXpath);
                    foreach ($format as $for){
                        $int_format .= $this->stringSpliter($for.chr(13).chr(10));
                    }
//                    $data[$i]['format'] = addslashes(substr($int_format,0, -1));
                    $int_format = html_entity_decode($int_format);
                    $data[$i]['format'] = $int_format;
                    $int_format = "";

                    //identifier
                    $dcidentifier = $ot->xpath($lrdcidentifierXpath);
                    foreach ($dcidentifier as $id){
                        $int_dcidentifier .= $id.chr(13).chr(10);
                    }
//                    for ($j=0; $j<1; $j++){
//                        $int_dcidentifier = $this->stringSpliter($dcidentifier[$j]);
//                    }
//                    $data[$i]['identifier'] = addslashes(substr($int_identifier,0, -1));
                    $int_dcidentifier = html_entity_decode($int_dcidentifier);
                    $int_dcidentifier = trim($int_dcidentifier);
                    $data[$i]['identifier'] = $int_dcidentifier;
                    $int_dcidentifier = "";

                    //source
                    $source = $ot->xpath($lrsourceXpath);
                    foreach ($source as $sou){
                        $int_source .= $this->stringSpliter($sou.chr(13).chr(10));
                        $int_source = html_entity_decode($int_source);
                    }
//                    $data[$i]['source'] = addslashes(substr($int_source,0, -1));
                    $data[$i]['source'] = $int_source;
                    $int_source = "";

                    //language
                    $language = $ot->xpath($lrlanguageXpath);
                    foreach ($language as $lang){
                        $int_language .= $this->stringSpliter($lang.chr(13).chr(10));
                        $int_language = html_entity_decode($int_language);
                    }
//                    $data[$i]['language'] = addslashes(substr($int_language,0, -1));
                    $data[$i]['language'] = $int_language;
                    $int_language = "";

                    //relation
                    $relation = $ot->xpath($lrrelationXpath);
                    foreach ($relation as $rel){
                        $int_relation .= $this->stringSpliter($rel.chr(13).chr(10));
                        $int_relation = html_entity_decode($int_relation);
                        $int_relation = str_ireplace('  ', '', $int_relation);
                    }
//                    $data[$i]['relation'] = addslashes(substr($int_relation,0, -1));
                    $data[$i]['relation'] = $int_relation;
                    $int_relation = "";


                    //rights
                    $rights = $ot->xpath($lrrightsXpath);
                    foreach ($rights as $ri){
                        $int_rights .= $this->stringSpliter($ri.chr(13).chr(10));
                        $int_rights = html_entity_decode($int_rights);
                    }
//                    $data[$i]['rights'] = addslashes(substr($int_rights,0, -1));
                    $data[$i]['rights'] = $int_rights;
                    $int_rights = "";
                    
                    /*********************Champs spatial****************************/
                    if($lrSpatial){
                        
                        $spatial = $ot->xpath($lrcoverageXpath);
                        foreach ($spatial as $spa){
                            foreach ($spa->attributes() as $nom => $valeur){
                                $int_spatial .= $this->stringSpliter($nom.'='.$valeur.chr(13).chr(10));
                                $int_spatial = html_entity_decode($int_spatial);
                            }
                        }
                    $data[$i]['coverage'] = $int_spatial;
                    $int_spatial = "";
                    }
                    else{
                        //coverage
                        $coverage = $ot->xpath($lrcoverageXpath);
                        foreach ($coverage as $cov){
                            $int_coverage .= $this->stringSpliter($cov.chr(13).chr(10));
                            $int_coverage = html_entity_decode($int_coverage);
                        }
                        $data[$i]['coverage'] = $int_coverage;
                        $int_coverage = "";
                    }
                    /*********************Champs spéciaux****************************/
                    if($lrSpecial){
                        $int_special = "";
                        $int_ispe = "";
                        foreach($lrSpecial as $spe)
                        {
                            $int_special = $ot->xpath($spe);
                            foreach ($int_special as $ispe){
                                $tempString=  $this->stringSpliter($ispe, $ispe->getName());
                                $int_ispe .= $tempString;
                                foreach ($ispe->attributes() as $nom => $valeur){
                                    $int_ispe .= $nom.'='.$valeur.chr(13).chr(10);
                                }
                            }
                            
                        }
                        $data[$i]['champs'] = $int_ispe;
                        $int_ispe = "";
                        $int_special = "";
                    }
                    
                    /*********************Métas ****************************/
                    if($lrMeta){
                        $int_meta = "";
                        $int_ismet = "";
                        foreach($lrMeta as $met)
                        {
                            $int_meta = $ot->xpath($met);
                            foreach ($int_meta as $ismeta){
                                if (substr_count($ismeta, "/*/")>0) {
                                    $ismeta = str_replace('/*/', ', ', $ismeta);
                                }
                                $int_ismet .= $ismeta.', ';
                            }
                            
                        }
                        $data[$i]['metadata'] = substr($int_ismet,0,-2);//On supprime le dernier ', espace'
                        $int_ismet = "";
                        $int_meta = "";
                    }
                    
                    /*********************Champs alias****************************/
                    if($lrAlias){
                        $int_alias = "";
                        $int_iali = "";
                        foreach($lrAlias as $ali)
                        {
                            $int_alias = $ot->xpath($ali);
                            foreach ($int_alias as $iali){
                                //$tempString=  $this->stringSpliter($iali, $iali->getName());
                                $int_iali .= $iali.'-';
//                                $int_iali .= $tempString;
                            }
                            
                        }
                        $int_iali = preg_replace("#\((.+)\)#", "",  $int_iali);
                        $int_iali = htmlentities($int_iali, ENT_NOQUOTES, 'utf-8');
                        $int_iali = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $int_iali);
                        $int_iali = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $int_iali); // pour les ligatures e.g. '&oelig;'
                        $int_iali = preg_replace('#&[^;]+;#', '', $int_iali); // supprime les autres caractères
                        $int_iali = str_replace('/*/', '-', $int_iali);
                        $int_iali = str_replace(' ', '-', $int_iali);
                        $int_iali = str_replace(',', '-', $int_iali);
                        $int_iali = str_replace('/', '-', $int_iali);
                        $int_iali = str_replace('--', '-', $int_iali);
                        $int_iali = substr($int_iali,0,strlen($int_iali)-1);
                        //echo($int_iali.'<br />');
                        $data[$i]['alias'] = $int_iali;
                        $int_iali = "";
                        $int_alias = "";
                    }
                    
                    /*********************Champs local_link****************************/
                    $relation = $ot->xpath($lrlocal_linkXpath);
                    $int_local_link = "";
                    if($lrlocal_linkXpath){
                        foreach ($relation as $rel){
                            $int_local_link = trim($rel);
                            $int_local_link = html_entity_decode($int_local_link);
                            $int_local_link = str_ireplace('  ', '', $int_local_link);
                            //$int_local_link = '<div id="myContentMP3">images/l21oai25/medias/mp3/'.$int_local_link.'</div>';
                            $int_local_link = '<div id="myContentMP3">'.$int_local_link.'</div>';
                        }
        //                    $data[$i]['relation'] = addslashes(substr($int_relation,0, -1));
                        $data[$i]['local_link'] = $int_local_link;
                        $int_local_link = "";
                    }
                    /*************************Champs transfert des erreurs*****************************/
                    $data[$i]['errors'] = $errors;
                    
                    //On a rempli une ligne on passe à la ligne suivante
                    $i++;
                }
                
                //L21oaiModelRecord::incrementalStores($data);
                
                //return $i;
                return $data;
            }
            
            /// Permet de splitter les chaine avec separateur interne (/*/ pour Sondaqui)
            protected function stringSpliter($string, $key= null ) {
                $splitted = "";
                if ($key != null) {
                    if (substr_count($string, "/*/")>0) {
                        $strings = explode("/*/", $string);
                        foreach ($strings AS $subString) {
                            $splitted .=$key . "=" . $subString . chr(13) . chr(10);
                        }
                    }
                    else
                    {
                        $splitted= $key . "=" . $string . chr(13) . chr(10);
                    }
                } else {
                    $splitted = str_replace("/*/", chr(13) . chr(10), $string);
                }
                return $splitted;
            }
}