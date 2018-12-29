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
            $ioaidcNamespace = "http://www.openarchives.org/OAI/2.0/oai-identifier";
            $idcXpath = "//d:gsdl_qdc";
            $idcNamespace = "http://purl.org/dc/elements/1.1/";
            $idescriptionXpath = 'child::c:description';
            $irelationXpath = 'child::c:relation';
/*************************************************/ 
            
/***************LISTSETS CONFIG LIST**************/
              //1er boucle
            $lssetNamespace = 'http://www.openarchives.org/OAI/2.0/';
            $lssetXpath = '//e:ListSets/e:set';
            $lssetSpecXpath = 'child::e:setSpec';
            $lssetNameXpath = 'child::e:setName';
              //2em boucle
            $lsSupInfo = false;//Si on a des informations complémentaires
            $lsoaidcNamespace = 'http://www.openarchives.org/OAI/2.0/oai_dc/';
            $lsdcXpath ='//d:gsdl_qdc';
            $lsdcNamespace = "http://purl.org/dc/elements/1.1/";
            $lstitleXpath = 'child::c:title';
            $lscreatorXpath = 'child::c:creator';
            $lsdescriptionXpath = 'child::c:description';
            $lstypeXpath = 'child::c:type';
/*************************************************/
            
/***************LISTRECORDS CONFIG LIST**************/
              //1er boucle
            $lrheadNamespace = "http://www.openarchives.org/OAI/2.0/";
            $lrlistRecordsXpath = "//a:ListRecords/a:record/a:header";
            $lridentifierXpath = "child::a:identifier";//=> IDENTIFIER
            $lrdatestampXpath = "child::a:datestamp";//=> DATESTAMP
            $lrsetSpecXpath = "child::a:setSpec"; //=> SETSPEC           
              //2em boucle
            $lrNamespace = "gsdl_qdc";
            
            $lroaidcNamespace = "http://greenstone.org/namespace/gsdl_qdc/1.0/";
            $lrdcXpath = "//d:gsdl_qdc";
            $lrdcNamespace = "http://purl.org/dc/terms/";
            
            $lrtitleXpath = 'child::c:title';//=> TITRE
            $lrtypeXpath = 'child::c:type';//=> TYPEDOCUMENT
            $lrcreatorXpath = 'child::c:creator';//=> AUTEUR
            $lrcontributorXpath = 'child::c:contributor';//=> CONTRIBUTEUR
            $lrdateXpath = 'child::c:date';//=> DATE PUBLI
            $lrcoverageXpath = 'child::c:coverage';//=> LIEU PUBLICATION
            $lrsubjectXpath = 'child::c:subject';//=> SUJET
            $lrlanguageXpath = 'child::c:language';//=> LANGUE
            $lrdcidentifierXpath = 'child::c:identifier';//=> RELATION / IDENTIFIER ?
            $lrdescriptionXpath = 'child::c:description';//=> DESCRIPTION
            $lrrightsXpath = 'child::c:rights';//=> DROITS
            $lrformatXpath = 'child::c:format';//=> FORMAT
            $lrsourceXpath = 'child::c:source';//=> SOURCE
            $lrpublisherXpath = 'child::c:publisher';//=> ETABLISSEMENT
            
            
            
            $lrrelationXpath = 'child::c:references';//=> MEDIA-URL => LE JPG
            
            
            
            
            
            //Remplissage du local_link avec les fichiers mp3
            $lrlocal_linkXpath = 'child::c:relation';//=> MP3
            
            

            //spéciaux
            $lrSpecial = array();
            $lrSpecial[] = 'child::c:mediator';//=> PRODUCTEUR
            $lrSpecial[] = 'child::c:alternative';//=> AUTRE AUTEUR
            $lrSpecial[] = 'child::c:rightsHolder';//=> INTERPRETE
            $lrSpecial[] = 'child::c:hasPart';//=> PARTICIPANT
            $lrSpecial[] = 'child::c:isRequiredBy';//=> SOUS NOTICE AUTEUR
            $lrSpecial[] = 'child::c:isVersionOf';//=> SOUS NOTICE TITRE
            $lrSpecial[] = 'child::c:isReplacedBy';//=> SOUS NOTICE TITRE CONV
            $lrSpecial[] = 'child::c:isFormatOf';//=> SOUS NOTICE DISTRIBUTION MUSICALE
            $lrSpecial[] = 'child::c:accessRights';//=> EDITION
            $lrSpecial[] = 'child::c:isPartOf';//=> PRESENTATION
            $lrSpecial[] = 'child::c:license';//=> EDITEUR PUBLI
            $lrSpecial[] = 'child::c:hasFormat';//=> IMPRESSION
            $lrSpecial[] = 'child::c:instructionalMethod';//=> DESCRIPTION MATERIELLE
            $lrSpecial[] = 'child::c:accrualPolicy';//=> DESCRIPTION MUSICAL
            $lrSpecial[] = 'child::c:created';//=> DISTRIB MUSICALE
            $lrSpecial[] = 'child::c:modified';//=> REPRODUCTION
            $lrSpecial[] = 'child::c:extent';//=> COLLECTION
            $lrSpecial[] = 'child::c:valid';//=> LIEN COLLECTION
            $lrSpecial[] = 'child::c:hasVersion';//=> NOTE
            $lrSpecial[] = 'child::c:abstract';//=> INDIDEWEY
            $lrSpecial[] = 'child::c:tableOfContents';//=> RUBRIC CLASSEMENT
            $lrSpecial[] = 'child::c:bibliographicCitation';//=> NUM NOTICE
            $lrSpecial[] = 'child::c:spatial';//=> DISTRIBUTEUR
            $lrSpecial[] = 'child::c:educationLevel';//=> THEME
            $lrSpecial[] = 'child::c:replaces';//=> GENRE
            $lrSpecial[] = 'child::c:requires';//=> TYPOLOGIE
            $lrSpecial[] = 'child::c:conformsTo';//=> IDENTIF COMMERCE
            $lrSpecial[] = 'child::c:isReferencedBy';//=> IDENTIF RELATION
            $lrSpecial[] = 'child::c:medium';//=> TYPOLOGIE OBJET
            $lrSpecial[] = 'child::c:provenance';//=> SOURCE PUBLISHER
            $lrSpecial[] = 'child::c:issued';//=> LOC INSEE
            $lrSpecial[] = 'child::c:accrualMethod';//=> X
            $lrSpecial[] = 'child::c:accrualPeriodicity';//=> Y
            $lrSpecial[] = 'child::c:audience';//=> METIER
            $lrSpecial[] = 'child::c:temporal';//=> PERIODE
            $lrSpecial[] = 'child::c:available';//=> LIEN PAGE SITE

            
            
            
            //metas
            $lrMeta = array();
            $lrMeta[] = 'child::c:creator';//auteurs
            
            //spatial
            $lrSpatial = false;
            //$lrcoverageXpath = 'child::c:spatial';//SPATIAL
            
            
            //Alias
            $lrAlias = array();
            $lrAlias[] = 'child::c:bibliographicCitation';//=> COTE

/*************************************************/            
            
/***************DOCUMENTS CONFIG LIST**************/
            $getsub = false;
            $sub = "";           
/*************************************************/                 
?>