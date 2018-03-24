<?php

/**
 * @version		$Id: entry.php 10 2011-03-22 22:12:42Z chdemko $
 * @package		Dictionary
 * @subpackage	Component
 * @copyright	Copyright (C) 2010 - today Christophe Demko, Inc. All rights reserved.
 * @author		Christophe Demko
 * @link		http://joomlacode.org/gf/project/dictionary/
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modeladmin library
jimport('joomla.application.component.modeladmin');
jimport('joomla.filesystem.folder');


/**
 * Entry Controller of Dictionary component
 */
class NemateriaModelNotice extends JModelAdmin
{
    public function getTable($type = 'Notice', $prefix = 'NemateriaTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm('com_nemateria.notice', 'notice', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form))
        {
            return false;
        }

        // Modify the form based on access controls.
//        if (!$this->canEditState((object)$data))
//        {
//                // Disable fields for display.
//                $form->setFieldAttribute('published', 'disabled', 'true');
//
//                // Disable fields while saving.
//                // The controller has already verified this is a record you can edit.
//
//                $form->setFieldAttribute('published', 'filter', 'unset');
//        }
        return $form;
    }
    /* Method to get a single record.
    *
    * @param	integer	$pk	The id of the primary key.
    *
    * @return	mixed	Object on success, false on failure.
    *
    * @note	Overload JModelAdmin::getItem
    */
    public function getItem($pk = null)
    {
        if ($item = parent::getItem($pk))
        {

            // Get the database object
            $db = JFactory::getDbo();
            // Get the variants
            $query = $db->getQuery(true);
            $query->select('id_collection , name, id_entrepot');
            $query->from($db->quoteName('#__nemateria_collections'));
            $db->setQuery($query);
            $item->collections = $db->loadObjectList();
            if ($db->getErrorNum())
            {
                $this->setError($db->getErrorMsg());
                return false;
            }
            // Get the database object
            $db = JFactory::getDbo();
            // Get the variants
            $query = $db->getQuery(true);
            $query->select('id_collection');
            $query->from($db->quoteName('#__nemateria_contient'));
            $query->where('id_notice='.(int)$item->id_notice);
            $db->setQuery($query);
            $idcollections= $db->loadObjectList();

            $idCollectionArray = array();
            foreach($idcollections AS $idcollection)
            {
                $idCollectionArray[]= $idcollection->id_collection;
            }
            $item->selectedCollections = $idCollectionArray;

            //Recupération de l'id_store pour affichage des images
            $query = $db->getQuery(true);
            $query->select('DISTINCT collections.id_entrepot');
            $query->from('#__nemateria_collections AS collections');
            $query->leftJoin('#__nemateria_contient AS contient ON collections.id_collection = contient.id_collection');
            $query->leftJoin('#__nemateria_notices AS notices ON notices.id_notice = contient.id_notice');
            $query->where('notices.id_notice='.(int)$item->id_notice);
            $db->setQuery($query);
            $item->id_entrepot = $db->loadResult();

            if ($db->getErrorNum())
            {
                $this->setError($db->getErrorMsg());
                return false;
            }

        }
        return $item;
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
    /**
     * Method to insert/update a record array into the database.
     *
     * @return	mixed	The status of the operation (errors of previous loops)
     *
     */
    function incrementalEntrepots($data, $force)
    {
        //extraction des données de contrôle
        //$token="";
        //echo $data['resumptionToken'];
        if(isset($data['resumptionToken'])){
            $token = $data['resumptionToken'];//resumptionToken du prochain set *contient "end" si fini*
            unset($data['resumptionToken']);//Supprime le resumptionToken du tableau de résultats pour ne pas avoir de notices vides
        }
        if(isset($data['xml_error'])){
            $xml_error = $data['xml_error'];//erreur de lecture xml
            unset($data['xml_error']);//Supprime le resumptionToken du tableau de résultats pour ne pas avoir de notices vides
        }
        if(isset($data['conf'])){
            $conf = $data['conf'];
            unset($data['conf']);
        }

        $post = $data;
        //Création d'un tableau pour stocker les messages et informations du processus
        $messages = '<h1 class="xml_rapport">Rapport page </h1>';
        //Création de variables de comptes
        $errors = 0;
        $new = 0;
        $maj = 0;
        $notmaj = 0;
        $locked = 0;
        $i=0;
        if($data && !isset($xml_error))
        {
            foreach($post as $postb)//On traite tous len enregistrements du tableau
            {
                $query = ' SELECT * FROM #__nemateria_notices WHERE unique_identifier = "'.$postb['unique_identifier'].'"';
                //echo $query.'<br/>';
                $this->_db->setQuery( $query );
                $tabs = $this->_db->loadObject();

                if(isset($tabs->unique_identifier) === FALSE)//Si on a pas l'identifier de la notice dans la bdd
                {
                    //echo '<h1>Raaa non !</h1> <br/>';
                    $new++;
//                            $messages[$i]['statut'] = '<p class="new getnew">Nouvel enregistrement</p>';

                    // Store the record thrue the JTable object
                    $messages .= $this->xmlStore($postb);//On enregistre la notice
                    $db = $this->_db;
                    $postb['id_notice'] = $db->insertid();//On enregistre l'id de la nouvelle notice
                }
                elseif(isset($tabs->unique_identifier) === TRUE && $tabs->locked == FALSE && $force == FALSE)//Si l'identifier existe, que la table n'est pas locked, que force est sur False
                {
                    $postb['id_notice'] = $tabs->id_notice;//On récupère l'id de la notice dans la BDD
                    if($postb['datestamp'] == $tabs->datestamp)//Si le datestamp est le même
                    {
                        $notmaj++;//On ne met pas à jour
                    }
                    else//Si le datestamp est différent
                    {
                        $maj++;
                        // Store the record thrue the JTable object
                        $messages .= $this->xmlStore($postb);//On met à jour la notice

                    }

                }
                elseif(isset($tabs->unique_identifier) === TRUE && $tabs->locked == FALSE && $force == TRUE)//Si l'identifier existe, que la table n'est pas locked, que force est sur TRUE
                {
                    $maj++;
                    $postb['id_notice'] = $tabs->id_notice;
                    // Store the record thrue the JTable object
                    $messages .= $this->xmlStore($postb);  //On met à jour la notice
                }
                else
                {
                    $postb['id_notice'] = $tabs->id_notice;
                    $locked++;//La mise à jour est bloqué car le locked est actif
                }

                $tabsetSpec = explode(";", $postb["setSpec"]);
                foreach( $tabsetSpec as $setSpec)
                {
//                                            var_dump($postb['id_record']);
//                        JFactory::getApplication()->close();
                    $query = 'SELECT * FROM #__nemateria_contient WHERE id_notice = "'. $postb['id_notice'] .'" AND id_collection="'.$setSpec.'"';
                    $this->_db->setQuery( $query );
                    $existTest = $this->_db->loadResult();

                    if (empty($existTest))
                    {

                        $query = 'insert into #__nemateria_contient (id_collection,id_notice) values ( '.$setSpec.', '. $postb['id_notice'].')';
                        $this->_db->setQuery( $query );
                        $this->_db->query();
                    }
                }

                //Traitement des erreus survenues dans l'import de chaque notice
                if($postb['errors']){
                    $messages .= '<h3>'.$postb['title'].'</h3>';
                    $messages .= $postb['errors'];
                }
                $i++;
            }
        }
        else{
            //Impossible de lire le xml, on arrete en envoyant end pat le token
            $token = 'end';
        }
        //$msg = JText::_('Page '.$i.' save');
        if(isset ($xml_error)){
            //$this->_writeLog($xml_error);
            $messages .= '<h2>'.JText::_("COM_NEMATERIA_PARSE_ERROR_TITLE").'</h2>';
            $messages .= '<p>'.JText::_("COM_NEMATERIA_PARSE_ERROR_DESC").'</p>';
        }
        $messages .= '<h3>'.$i.JText::_("COM_NEMATERIA_IMPORT_CHECKED").'</h3>';
        $messages .= '<input type="hidden" class="total" value="'.$i.'" />';
        if($new > 0){
            $messages .= '<p>'.$new.JText::_("COM_NEMATERIA_IMPORT_IMPORTED_COLLECTION").'</p>';
            $messages .= '<input type="hidden" class="new" value="'.$new.'" />';
        }
        if($maj > 0){
            $messages .= '<p>'.$maj.JText::_("COM_NEMATERIA_IMPORT_UPDATED").'</p>';
            $messages .= '<input type="hidden" class="maj" value="'.$maj.'" />';
        }
        if($notmaj > 0){
            $messages .= '<p>'.$notmaj.JText::_("COM_NEMATERIA_IMPORT_ANALYSED").'</p>';
            $messages .= '<input type="hidden" class="notmaj" value="'.$notmaj.'" />';
        }
        if($locked > 0){
            $messages .= '<p>'.$locked.JText::_("COM_NEMATERIA_IMPORT_LOCKED").'</p>';
            $messages .= '<input type="hidden" class="locked" value="'.$locked.'" />';
        }
        if(isset($token)){//Si la page a plenté on a pas de token
            $messages .= '<input type="hidden" class="last_rt" value="'.$token.'" />';
        }
        $messages .= '<hr noshade size="3" style="float:left; width:100%;">';

        return $messages;

    }

    protected function xmlStore($notice)
    {
        $messages ="";
        $row = $this->getTable('notice');
        if (!$row->save($notice)){
            $messages .= '<h3>'.$notice['title'].'</h3>';
            $messages .= '<p class="error">Insert: erreur.</p>';
        }
        return $messages;
    }

    /**
     * Method to save the form data.
     *
     * @param	array	$data	The form data.
     *
     * @return	boolean	True on success.
     *
     * @note	Overload JModelAdmin::save
     */
    public function save($data)
    {

        $id_collections = $data['id_collection'];
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('title, creator, subject, description, publisher,
                    contributor, date, format, identifier, source, language,
                    relation, coverage, rights, datestamp, metadata, champs, published, alias');
        $query->from('#__nemateria_notices');
        $query->where("id_notice='".$data['id_notice']."'");
        $db->setQuery( $query );
        $checkItems = $db->loadAssocList();

        //Preparation des arrays servant a la comparaison

        $checkData = $data;
        $checkData['id_collection']="";
        $checkData = array_map('trim', $checkData);

        $carriageReturn= array(chr(13),chr(10));

        foreach($checkData AS $chkDataRow)
        {
            $chkDataRow = str_replace($carriageReturn, "",$chkDataRow);

        }

        $checkItems[0] = array_map('trim', $checkItems[0]);

        foreach($checkItems[0] AS $chkItemRow)
        {
            $chkItemRow = str_replace($carriageReturn, "",$chkItemRow);

        }
        //Comparaison
        $testResult = array_diff($checkItems[0], $checkData);

        if(!empty($testResult))
        {
            $data['locked']= 1;
        }
        if (parent::save($data))
        {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->delete();
            $query->from('#__nemateria_contient');
            $query->where("id_notice='".$data['id_notice']."'");
            $db->setQuery($query);
            $db->query();
            if ($db->getErrorNum())
            {
                $this->setError($db->getErrorMsg());
                return false;
            }
            foreach($id_collections AS $id_collection)
            {
                $db = JFactory::getDbo();
                $query = $db->getQuery(true);
                $query->insert('#__nemateria_contient');
                $query->set("id_collection='".$id_collection."', id_notice='".$data[id_notice]."'");
                $db->setQuery($query);
                $db->query();
                if ($db->getErrorNum())
                {
                    $this->setError($db->getErrorMsg());
                    return false;
                }
            }

            return true;
        }
        return false;

    }

}
