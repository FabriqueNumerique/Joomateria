<?php

/**
 * @version		$Id: entry.php 42 2011-03-31 09:12:23Z chdemko $
 * @package		l21oai25
 * @subpackage	Component
 * @copyright	Copyright (C) 2010-today Christophe Demko. All rights reserved.
 * @author		Christophe Demko
 * @link		http://joomlacode.org/gf/project/l21oai25/
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modeladmin library
jimport('joomla.application.component.modeladmin');


/**
 * Entry Model of l21oai25 component
 */
class NemateriaModelEntrepot extends JModelAdmin
{


    /**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param	string	$type	The table type to instantiate.
     * @param	string	$prefix	A prefix for the table class name.
     * @param	array	$config	Configuration array for model. Optional.
     *
     * @return	JTable	A database object
     *
     * @note	Overload JModel::getTable
     */
    public function getTable($type = 'Entrepot', $prefix = 'NemateriaTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }


    /**
     * Method to get the record form.
     *
     * @param	array	$data		Data for the form.
     * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
     *
     * @return	mixed	A JForm object on success, false on failure
     *
     * @note	Overload JModelForm::getForm
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm('com_nemateria.entrepot', 'entrepot', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form))
        {
            return false;
        }


        return $form;
    }
    function getInfoentrepot($url, $conf)
    {
        /***************IDENTIFY CONFIG LIST**************/
        //1er boucle
//            $iheadNamespace = "http://www.openarchives.org/OAI/2.0/";
//            $iidentifyXpath = "//a:Identify";
//            $iearliestDatestampXpath = "child::a:earliestDatestamp";
//            $igranularityXpath = "child::a:granularity";
//            $iadminEmailXpath = "child::a:adminEmail";
//            $irepositoryNameXpath = "child::a:repositoryName";
        //2em boucle
//            $ioaidcNamespace = "http://www.openarchives.org/OAI/2.0/oai_dc/";
//            $idcXpath = "//d:dc";
//            $idcNamespace = "http://purl.org/dc/elements/1.1/";
//            $idescriptionXpath = 'child::c:description[@xml:lang="fre"]';
//            $irelationXpath = 'child::c:relation';
        /*************************************************/
        include_once (JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_nemateria'.DIRECTORY_SEPARATOR.'configuration'.DIRECTORY_SEPARATOR.$conf);


        $entrepot_url = $url."?verb=Identify";
        //$xml = simplexml_load_file($sets_url);
        $collections = file_get_contents($entrepot_url);
        $xml = new SimpleXmlElement($collections);

        //On instencie un espace de nom correspondant a la balise oai_dc:dc
        $xml->registerXPathNamespace('d', $ioaidcNamespace);
        //On instencie la node oai_dc:dc et tout ce qu'elle contient comme un nouveau document xml par xpath
        $oai = $xml->xpath($idcXpath);

        //on va mettre en place un tableau qui contiendra les données de chaque set par ligne
        $data = array();
        //on va chercher dans le xml les information non dc => setspec et setname
        $i=0;
        $xml->registerXPathNamespace('a', $iheadNamespace);
        $xpath = $iidentifyXpath;
        $ListRecords = $xml->xpath($xpath);
        //Variables intermédiaires
        $int_earliestDatestamp = "";
        $int_granularity = "";
        $int_adminEmail = "";
        $int_repositoryName = "";

        foreach ($ListRecords as $it)
        {
            $it->registerXPathNamespace('a', $iheadNamespace);
            $repositoryName = $it->xpath($irepositoryNameXpath);
            foreach ($repositoryName as $rep)
            {
                $int_repositoryName .= $rep.';';
            }
            $data[$i]['repositoryName' ] = substr($int_repositoryName, 0, -1);
            $int_repositoryName = "";

            $adminEmail = $it->xpath($iadminEmailXpath);
            foreach ($adminEmail as $adm)
            {
                $int_adminEmail .= $adm.';';
            }
            $data[$i]['adminEmail' ] = substr($int_adminEmail, 0, -1);
            $int_adminEmail = "";

            $granularity = $it->xpath($igranularityXpath);
            foreach ($granularity as $gra)
            {
                $int_granularity .= $gra.';';
            }
            $data[$i]['granularity' ] = substr($int_granularity, 0, -1);
            $int_granularity = "";

            $earliestDatestamp = $it->xpath($iearliestDatestampXpath);
            foreach ($earliestDatestamp as $ear)
            {
                $int_earliestDatestamp .= $ear.';';
            }
            $data[$i]['earliestDatestamp' ] = substr($int_earliestDatestamp, 0, -1);
            $int_earliestDatestamp = "";

            $i++;
        }

        $i=0;

        //On va maintenant récupérer les autres informations contenus dans oai_dc:dc

        $int_description = "";
        $int_relation = "";

        foreach ($oai as $ot)
        {
            //description
            $ot->registerXPathNamespace('c', $idcNamespace);
            $description = $ot->xpath($idescriptionXpath);
            $int_description = $description[0];

            $relation = $ot->xpath($irelationXpath);
            $int_relation = $relation[0];


            $i++;
        }

        $data[0]['description'] = $int_description;
        $data[0]['relation'] = $int_relation;
//            $data[0]['config'] = $conf->name;

        return $data;
    }
    /**
     * Method to get the data that should be injected in the form.
     *
     * @return	mixed	The data for the form.
     *
     * @note	Overload JModelForm::loadFormData
     */
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState('com_nemateria.edit..data', array());
        if (empty($data))
        {
            $data = $this->getItem();


        }
        return $data;
    }




}