<?php
/***************IDENTIFY CONFIG LIST**************/
    //1er boucle
            $iheadNamespace = "http://www.openarchives.org/OAI/2.0/";
            $iidentifyXpath = "//a:Identify";
            $iearliestDatestampXpath = "child::a:earliestDatestamp";
            $igranularityXpath = "child::a:granularity";
            $iadminEmailXpath = "child::a:adminEmail";
            $irepositoryNameXpath = "child::a:repositoryName";
    //2em boucle
            $ioaidcNamespace = "http://oai.dlib.vt.edu/OAI/metadata/toolkit";
            $idcXpath = "//d:toolkit";
            $idcNamespace = "http://oai.dlib.vt.edu/OAI/metadata/toolkit";
            $idescriptionXpath = 'child::c:title';
            $irelationXpath = 'child::c:URL';
/*************************************************/ 

/***************LISTSETS CONFIG LIST**************/
     //1er boucle
            $lssetNamespace = 'http://www.openarchives.org/OAI/2.0/';
            $lssetXpath = '//e:ListSets/e:set';
            $lssetSpecXpath = 'child::e:setSpec';
            $lssetNameXpath = 'child::e:setName';
    //2em boucle
            $lsoaidcNamespace = 'http://www.openarchives.org/OAI/2.0/';
            $lsdcXpath ='//d:ListSets/e:set';
            $lsdcNamespace = "http://purl.org/dc/elements/1.1/";
            $lstitleXpath = "child::c:setSpec";
            $lscreatorXpath = 'child::c:setSpec';
            $lsdescriptionXpath = 'child::c:setSpec';
            $lstypeXpath = 'child::c:setSpec';
/*************************************************/
            
/***************LISTRECORDS CONFIG LIST**************/
              //1er boucle
            $lrheadNamespace = "http://www.openarchives.org/OAI/2.0/";
            $lrlistRecordsXpath = "//a:ListRecords/a:record/a:header";
            $lridentifierXpath = "child::a:identifier";
            $lrdatestampXpath = "child::a:datestamp";
            $lrsetSpecXpath = "child::a:setSpec";            
              //2em boucle
            $lrNamespace = "ap";
            
            $lroaidcNamespace = "http://patrimoines.aquitaine.fr/ap/format-pivot/1.1";
            $lrdcXpath = "//d:ressource";
            $lrdcNamespace = "http://patrimoines.aquitaine.fr/ap/format-pivot/1.1";
            //Normaux
            $lrdcidentifierXpath = 'child::c:identifier';
            $lrtitleXpath = 'child::c:title';
            $lrsubjectXpath = 'child::c:subject';
            $lrdescriptionXpath = 'child::c:description';         
            $lrpublisherXpath = 'child::c:publisher'; 
            $lrlanguageXpath = 'child::c:language';
            $lrsourceXpath = 'child::c:source';
            $lrrightsXpath = 'child::c:rights';
            $lrdateXpath = 'child::c:datation';//date
            //Renommés
            $lrformatXpath = 'child::c:media-typologie';//format
            $lrtypeXpath = 'child::c:typologieObjet';//type
            $lrrelationXpath = 'child::c:media-url';//relation
            $lrcreatorXpath = 'child::c:artiste';//creator
            
            //Spatial
            $lrSpatial = true;
            $lrcoverageXpath = 'child::c:spatial';//coverage
            
            //spéciaux
            $lrSpecial = array();
            $lrSpecial[] = 'child::c:metier';//
            $lrSpecial[] = 'child::c:etablissement';//
            $lrSpecial[] = 'child::c:locinsee';//
            //$lrSpecial[] = 'child::c:date';//
            
            //non utilisé
            $lrcontributorXpath = 'child::c:contributor';
            //$lrdateXpath = 'child::c:date';
            
            //metas
            $lrMeta = array();
            $lrMeta[] = 'child::c:artiste';//auteurs
            $lrMeta[] = 'child::c:datation';//instruments
            $lrMeta[] = 'child::c:subject';//fetes
            
            //Alias
            $lrAlias = array();
            $lrAlias[] = 'child::c:artiste';//=> COTE
            $lrAlias[] = 'child::c:title';//=> COTE
            $lrAlias[] = 'child::c:subject';//fetes
            
            //Remplissage du local_link avec les fichiers mp3
            $lrlocal_linkXpath = false;//=> MP3
            
            
/*************************************************/ 
            
/***************DOCUMENTS CONFIG LIST**************/
            $getsub = false;           
/*************************************************/  
?>
