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
            $lrcreatorXpath = 'child::c:creator';//=> AUTEURS
            $lrsubjectXpath = 'child::c:subject';//=> DOMAINE
            $lrlanguageXpath = 'child::c:language';//=> LANGUE
            $lrdateXpath = 'child::c:date';//=> DATE
            $lrtypeXpath = 'child::c:type';//=> TYPEDOCUMENT
            $lrrightsXpath = 'child::c:rights';//=> DROIT
            $lrpublisherXpath = 'child::c:publisher';//=> EDITEUR
            $lrsourceXpath = 'child::c:source';//=> SOURCE
            $lrrelationXpath = 'child::c:references';//=> MEDIA-URL => LE JPG
            $lrdescriptionXpath = 'child::c:description';//=> DESCRIPTEURS
            $lrcontributorXpath = 'child::c:contributor';//=> DANSES
            $lrcoverageXpath = 'child::c:coverage';//=> EFFECTIFS
            $lrdcidentifierXpath = 'child::c:identifier';//=> IDENTIFIER
            
            //Remplissage du local_link avec les fichiers mp3
            $lrlocal_linkXpath = 'child::c:alternative';//=> MP3
            
            $lrformatXpath = 'child::c:format';//En double dans champs

            //spéciaux
            $lrSpecial = array();
            $lrSpecial[] = 'child::c:extent';//=> FONDS
            $lrSpecial[] = 'child::c:available';//=> LIEUCONSULTATION
            $lrSpecial[] = 'child::c:dateAccepted';//=> DATEENREGISTREMENT
            $lrSpecial[] = 'child::c:issued';//=> LOCALISATION
            $lrSpecial[] = 'child::c:medium';//=> SUPPORT
            $lrSpecial[] = 'child::c:conformsTo';//=> COTE
            $lrSpecial[] = 'child::c:isReferencedBy';//=> REFERENCE
            $lrSpecial[] = 'child::c:accrualMethod';//=> X
            $lrSpecial[] = 'child::c:accrualPeriodicity';//=> Y
            $lrSpecial[] = 'child::c:temporal';//=> PERIODE
            $lrSpecial[] = 'child::c:audience';//=> METIER
            $lrSpecial[] = 'child::c:mediator';//=> INSTRUMENTS
            $lrSpecial[] = 'child::c:abstract';//=> TECHNIQUEVOCALE
            $lrSpecial[] = 'child::c:provenance';//=> PROVENANCE
            $lrSpecial[] = 'child::c:bibliographicCitation';//=> COMPLEMENTPROVENANCE
            $lrSpecial[] = 'child::c:requires';//=> SITUATIONENREGISTREMENT
            $lrSpecial[] = 'child::c:hasPart';//=> MATERIELACCOMPAGNEMENT
            
            $lrSpecial[] = 'child::c:relation';//=> IMG1
            $lrSpecial[] = 'child::c:format';//=> IMG2
            $lrSpecial[] = 'child::c:license';//=> IMG3
            $lrSpecial[] = 'child::c:created';//=> IMG4
            $lrSpecial[] = 'child::c:modified';//=> IMG5
            
            $lrSpecial[] = 'child::c:replaces';//=> FORMETEXTE
            $lrSpecial[] = 'child::c:accrualPolicy';//=> QUALITEDOCUMENT
            $lrSpecial[] = 'child::c:dateSubmitted';//=> DATEDEPOT
            $lrSpecial[] = 'child::c:instructionalMethod';//=> COMMENTAIRE
            $lrSpecial[] = 'child::c:isPartOf';//=> FETE
            
            //metas
            $lrMeta = array();
            $lrMeta[] = 'child::c:creator';//auteurs
            $lrMeta[] = 'child::c:isReferencedBy';//reference
            $lrMeta[] = 'child::c:description';//descripteurs
            $lrMeta[] = 'child::c:mediator';//instruments
            $lrMeta[] = 'child::c:isPartOf';//fetes
            
            //spatial
            $lrSpatial = true;
            $lrcoverageXpath = 'child::c:spatial';//SPATIAL
            
            
            //Alias
            $lrAlias = array();
            $lrAlias[] = 'child::c:conformsTo';//=> COTE

/*************************************************/            
            
/***************DOCUMENTS CONFIG LIST**************/
            $getsub = false;
            $sub = "";           
/*************************************************/                 
?>
