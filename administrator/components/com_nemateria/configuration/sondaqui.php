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
            $lrsetSpecXpath = "child::a:setSpec";//existe pas            
              //2em boucle
            $lrNamespace = "oai_dc";
            
            $lroaidcNamespace = "http://www.openarchives.org/OAI/2.0/oai_dc/";
            $lrdcXpath = "//d:dc";
            $lrdcNamespace = "http://purl.org/dc/elements/1.1/";
            $lrtitleXpath = 'child::c:titre';
            $lrcreatorXpath = 'child::c:auteurs';
            $lrsubjectXpath = 'child::c:domaine';
            $lrdescriptionXpath = 'child::c:descripteurs';
            $lrpublisherXpath = 'child::c:lieuconsultation';
            $lrcontributorXpath = 'child::c:reference';
            $lrdateXpath = 'child::c:datedeparution';
            $lrtypeXpath = 'child::c:typedocument';
            $lrformatXpath = 'child::c:cote';
            $lrdcidentifierXpath = 'child::c:serial';
            $lrsourceXpath = 'child::c:localisation';
            $lrlanguageXpath = 'child::c:langue';
            $lrrelationXpath = 'child::c:fichiersnumeriqueslies';
            $lrcoverageXpath = 'child::c:localisation';
            $lrrightsXpath = 'child::c:droit';
            //Remplissage du local_link avec les fichiers mp3
            $lrlocal_linkXpath = 'child::c:fichiersnumeriqueslies';
            
            //speciaux
            $lrSpatial = false;
            $lrSpecial = array();
            $lrSpecial[] = 'child::c:datedepot';//
            $lrSpecial[] = 'child::c:dateenregistrement';//
            $lrSpecial[] = 'child::c:descripteurs';//
            $lrSpecial[] = 'child::c:categorieautochtone';//
            $lrSpecial[] = 'child::c:instruments';//
            $lrSpecial[] = 'child::c:danses';//
            $lrSpecial[] = 'child::c:roleetusage';//
            $lrSpecial[] = 'child::c:expression';//
            $lrSpecial[] = 'child::c:provenance';//
            $lrSpecial[] = 'child::c:complementprovenance';//
            $lrSpecial[] = 'child::c:situationenregistrement';//
            
            
            //Alias
            $lrAlias = false;
            $lrAlias = array();
            $lrAlias[] = 'child::c:descripteurs';//
            $lrAlias[] = 'child::c:categorieautochtone';//
            $lrAlias[] = 'child::c:instruments';//
            $lrAlias[] = 'child::c:danses';//
            $lrAlias[] = 'child::c:auteurs';//
/*************************************************/            
            
/***************DOCUMENTS CONFIG LIST**************/
            $getsub = true;
            $sub = "vignette : ";           
/*************************************************/                 
?>
