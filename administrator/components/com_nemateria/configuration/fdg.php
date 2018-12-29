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
            $lridentifierXpath = "child::a:identifier";
            $lrdatestampXpath = "child::a:datestamp";
            $lrsetSpecXpath = "child::a:setSpec";           
              //2em boucle
            $lrNamespace = "gsdl_qdc";
            
            $lroaidcNamespace = "http://greenstone.org/namespace/gsdl_qdc/1.0/";
            $lrdcXpath = "//d:gsdl_qdc";
            $lrdcNamespace = "http://purl.org/dc/terms/";
            
            $lrtitleXpath = 'child::c:title';// Titre
            $lrcreatorXpath = 'child::c:creator';// Auteur
            $lrsubjectXpath = 'child::c:subject';// Mots clés
            $lrdescriptionXpath = 'child::c:description';// Résumé
            $lrpublisherXpath = 'child::c:publisher';// Publié par
            $lrcontributorXpath = 'child::c:contributor';// Participants
            $lrdateXpath = 'child::c:date';// Date
            $lrtypeXpath = 'child::c:type';// Type de contenu
            $lrformatXpath = 'child::c:format';// Format de fichier
            $lrdcidentifierXpath = 'child::c:identifier';// Référence
            $lrsourceXpath = 'child::c:source';// Réf original
            $lrcoverageXpath = 'child::c:coverage';// Lieu concerné
            $lrrightsXpath = 'child::c:rights';// Statut juridique
            $lrlanguageXpath = 'child::c:language';// Langues utilisées
            //Que mettre dans relation ?
            $lrrelationXpath = 'child::c:references';// Fréquence vidéo

            
            $lrlocal_linkXpath = 'child::c:alternativeTitle';// Informateur
            
            

            //spéciaux
            $lrSpecial = array();
            $lrSpecial[] = 'child::c:extent';// Nature et durée
            $lrSpecial[] = 'child::c:tableOfContents';// Alias
            $lrSpecial[] = 'child::c:dateIssued';// Date numérisation
            $lrSpecial[] = 'child::c:isVersionOf';// Début séq
            $lrSpecial[] = 'child::c:medium';// Description original
            $lrSpecial[] = 'child::c:hasVersion';// Durée séq
            $lrSpecial[] = 'child::c:isReferencedBy';// Fréquence audio
			$lrSpecial[] = 'child::c:references';// Fréquence vidéo
            $lrSpecial[] = 'child::c:accrualMethod';// Département
            $lrSpecial[] = 'child::c:accrualPeriodicity';// Commune
            $lrSpecial[] = 'child::c:isReplacedBy';// Résumé de séquence
            $lrSpecial[] = 'child::c:audience';// Né(e) en
            $lrSpecial[] = 'child::c:mediator';// Numérisé par
            $lrSpecial[] = 'child::c:abstract';// Objet entretient
            $lrSpecial[] = 'child::c:provenance';// Producteurs_et_partenaires
            $lrSpecial[] = 'child::c:bibliographicCitation';// Voir dans nos collections
            $lrSpecial[] = 'child::c:requires';// Doc requis
            $lrSpecial[] = 'child::c:hasPart';// Contient
            
            $lrSpecial[] = 'child::c:relation';// Collection
            $lrSpecial[] = 'child::c:isFormatOf';// Voir sur le web
            $lrSpecial[] = 'child::c:license';// Gestionnaire_des_droits
            $lrSpecial[] = 'child::c:hasFormat';// Format master numérique
            $lrSpecial[] = 'child::c:dateCopyrighted';// Proprietaire_supports_originaux
            
            $lrSpecial[] = 'child::c:replaces';// Numéro séq
            $lrSpecial[] = 'child::c:accrualPolicy';// Lieu-dit
            $lrSpecial[] = 'child::c:audienceEducationLevel';// Conservation_des_originaux
            $lrSpecial[] = 'child::c:instructionalMethod';// Code Postal
            $lrSpecial[] = 'child::c:isPartOf';// Série
            $lrSpecial[] = 'child::c:accessRights'; // Conservation_des_masters
            $lrSpecial[] = 'child::c:rightsHolder'; // Détenteur_des_droits
            $lrSpecial[] = 'child::c:temporalCoverage'; // Période concernée
            $lrSpecial[] = 'child::c:dateValid'; // Pays
			$lrSpecial[] = 'child::c:conformsTo'; // Supplément
            
            //metas
            $lrMeta = array();
            $lrMeta[] = 'child::c:creator';//
            $lrMeta[] = 'child::c:isReferencedBy';//
            $lrMeta[] = 'child::c:description';//
            $lrMeta[] = 'child::c:mediator';//
            $lrMeta[] = 'child::c:isPartOf';//
            
            //spatial
            $lrSpatial = false;
            $lrcoverageXpath = 'child::c:spatial';//
            
            
            //Alias
            $lrAlias = array();
            $lrAlias[] = 'child::c:title';//

/*************************************************/            
            
/***************DOCUMENTS CONFIG LIST**************/
            $getsub = false;
            $sub = "";           
/*************************************************/                 
?>
