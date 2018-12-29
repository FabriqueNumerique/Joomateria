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
            $ioaidcNamespace = "http://www.openarchives.org/OAI/2.0/oai_dc/";
            $idcXpath = "//d:dc";
            $idcNamespace = "http://purl.org/dc/elements/1.1/";
            $idescriptionXpath = 'child::c:description[@xml:lang="fre"]';
            $irelationXpath = 'child::c:relation';
/*************************************************/ 
            
/***************LISTSETS CONFIG LIST**************/
              //1er boucle
            $lssetNamespace = 'http://www.openarchives.org/OAI/2.0/';
            $lssetXpath = '//e:ListSets/e:set';
            $lssetSpecXpath = 'child::e:setSpec';
            $lssetNameXpath = 'child::e:setName';
              //2em boucle
            $lsoaidcNamespace = 'http://www.openarchives.org/OAI/2.0/oai_dc/';
            $lsdcXpath ='//d:dc';
            $lsdcNamespace = "http://purl.org/dc/elements/1.1/";
            $lstitleXpath = 'child::c:title[@xml:lang="fr"]';
            $lscreatorXpath = 'child::c:creator';
            $lsdescriptionXpath = 'child::c:description[@xml:lang="fr"]';
            $lstypeXpath = 'child::c:type[@xml:lang="fr"]';
/*************************************************/
            
/***************LISTRECORDS CONFIG LIST**************/
              //1er boucle
            $lrheadNamespace = "http://www.openarchives.org/OAI/2.0/";
            $lrlistRecordsXpath = "//a:ListRecords/a:record/a:header";
            $lridentifierXpath = "child::a:identifier";
            $lrdatestampXpath = "child::a:datestamp";
            $lrsetSpecXpath = "child::a:setSpec";            
              //2em boucle
            $lrNamespace = "oai_dc";
            
            $lroaidcNamespace = "http://www.openarchives.org/OAI/2.0/oai_dc/";
            $lrdcXpath = "//d:dc";
            $lrdcNamespace = "http://purl.org/dc/elements/1.1/";
            $lrtitleXpath = 'child::c:title';
            $lrcreatorXpath = 'child::c:creator';
            $lrsubjectXpath = 'child::c:subject';
            $lrdescriptionXpath = 'child::c:description';
            $lrpublisherXpath = 'child::c:publisher';
            $lrcontributorXpath = 'child::c:contributor';
            $lrdateXpath = 'child::c:date';
            $lrtypeXpath = 'child::c:type';
            $lrformatXpath = 'child::c:format';
            $lrdcidentifierXpath = 'child::c:identifier';
            $lrsourceXpath = 'child::c:source';
            $lrlanguageXpath = 'child::c:language';
            $lrrelationXpath = 'child::c:relation';
            $lrcoverageXpath = 'child::c:coverage';
            $lrrightsXpath = 'child::c:rights';
            
            //speciaux
            $lrSpatial = false;
            $lrSpecial = false;
            
            //metas
            $lrMeta = array();
            $lrMeta[] = 'child::c:creator';//auteurs
            $lrMeta[] = 'child::c:title';//titre
            
            //Alias
            $lrAlias = array();
            $lrAlias[] = 'child::c:title';//=> titre
            
            //Remplissage du local_link avec les fichiers mp3
            $lrlocal_linkXpath = false;//=> MP3

/*************************************************/            
            
/***************DOCUMENTS CONFIG LIST**************/
            $getsub = true;
            $sub = "vignette : ";           
/*************************************************/                 
?>
