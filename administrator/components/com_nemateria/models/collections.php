<?php

/**
 * @version		$Id: view.html.php 42 2011-03-31 09:12:23Z chdemko $
 * @package		L21oai25
 * @subpackage	Component
 * @copyright	Copyright (C) 2010-today Christophe Demko. All rights reserved.
 * @author		Christophe Demko
 * @link		http://joomlacode.org/gf/project/l21oai25/
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the Joomla modellist library
jimport('joomla.application.component.modellist');

// import the joomla language library
//jimport('joomla.language.helper');

// import component helper
JLoader::register('NemateriaHelper', JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_nemateria' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'nemateria.php');

/**
 * Sets Model of L21oai25 component
 */
class NemateriaModelCollections extends JModelList
{
    // Set the authorized ordering fields
    protected $filter_fields = array('title', 'name', 'creator');

    /**
     * Constructor.
     *
     * @param	array	$config An optional associative array of configuration settings.
     * @see		JController
     */
    public function __construct($config = array())
    {
        parent::__construct($config);

        // Get all lan,guage tags
//		$tags = JArrayHelper::getColumn(JLanguageHelper::getLanguages(), 'lang_code');

        // Create tables for variants
//		L21oai25Helper::createTitleTables($tags);
    }

    /**
     * Method to auto-populate the model state.
     *
     * @param	string	$ordering	An optional ordering field.
     * @param	string	$direction	An optional direction (asc|desc).
     *
     * @return void
     *
     * @note	List of internal states
     *			- filter.search			title to search for
     *			- filter.access			array of access levels for filtering
     *			- filter.published		array of states for filtering
     *			- filter.category_id	array of catid for filtering
     *			- filter.language		array of language code for filtering
     *			- list.limit			number of items retrieved for the collection (defined in JModelList)
     *			- list.start			starting index of items for the collection (defined in JModelList)
     *			- list.ordering			field for ordering the collection
     *			- list.direction		direction of ordering (asc or desc)
     *
     * @see		JModelList
     */
    protected function populateState($ordering = null, $direction = null)
    {
        // Set the filter.search state
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        if ($search != '')
        {
            $this->setState('filter.search', $search);
        }

        // Call populateState from JModelList
        parent::populateState('name', $direction);

    }

    /**
     * Method to get a JDatabaseQuery object for retrieving the data set from a database.
     *
     * @return	object	A JDatabaseQuery object to retrieve the data set.
     *
     * @see		JModelList
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);

        // Select some fields
        $query->select('*			
		');

        // From the l21oai25_sets table
        $query->from('#__nemateria_collections as e');

        // Filter by search in title
        if ($search = $this->getState('filter.search'))
        {
            $search = $db->Quote('%' . $db->escape($search, true) . '%');
            $query->where('(name LIKE ' . $search . ')');
        }

        if($filter_entrepot= JFactory::getApplication()->input->get( 'filter_entrepot' ))
        {
            $query->where('id_entrepot ='.$filter_entrepot );
        }
//                // Add the list ordering clause.
        $ordering = $this->getState('list.ordering');
        $direction = $this->getState('list.direction');

        if ($ordering)
        {
            $query->order($db->escape($ordering) . ' ' . $db->escape($direction));
        }
        return $query;
    }

    /**
     * Method to get an array of data items.
     *
     * @return	mixed	An array of data items on success, false on failure.
     *
     * @see		JModelList
     */
    public function getItems()
    {
        // Get a storage key.
        $collections = $this->getStoreId();

        // Try to load the data from internal storage.
        if (!empty($this->cache[$collections]))
        {
            return $this->cache[$collections];
        }

        // Get the items from JModelList
        $items = parent::getItems();
        if ($this->getError())
        {
            return false;
        }
        foreach($items as $item)
        {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);

            // Select some fields
//			$query->select('alternate');
//			$query->from($db->nameQuote('#__l21oai25_sets_variants_' . $item->language));
//			$query->where('eid=' . $item->id);
//			$query->order('ordering');
            $db->setQuery($query);
//			$item->variants = $db->loadResultArray();
            if ($db->getErrorNum())
            {
                $this->setError($db->getErrorMsg());
                return false;
            }
        }

        // Add the items to the internal cache.
        $this->cache[$collections] = $items;
        return $this->cache[$collections];
    }

    public function delete()
    {
        // Check for request forgeries
        //JRequest::checkToken() or jexit( JText::_('RECORD_DEL_INVALID_TOKEN') );

        //On importe la classe de Joomla permettant de manipuler les fichiers
        jimport('joomla.filesystem.file');

        $cids = JRequest::getVar('cid', array(0), 'post', 'array');

        if(count($cids))
        {
            foreach($cids as $cid)
            {
                $doc = array();
                //Récupération des informations lié a la notice: l'id entrepot
                //On récupère les informations AVANT l'effacement
                $db =& JFactory::getDBO();
                $queryI  = 'SELECT contient.id_notice ';
                $queryI .= 'FROM ';
                $queryI .= '#__nemateria_contient as contient ';
                $queryI .= 'WHERE contient.id_collection = '.$cid;

                $db->setQuery($queryI);
                $doc = $db->loadObjectList();//Tableau d'objets

                $q  = 'SELECT collections.id_entrepot ';
                $q .= 'FROM ';
                $q .= '#__nemateria_collections as collections ';
                $q .= 'WHERE collections.id_collection = '.$cid;

                $db->setQuery($queryI);
                $entrepot = $db->loadResult();//Tableau d'objets
                // => Supression des images associé à la notice

                $ids_notices = "";
                foreach ($doc as $d){
                    //Suppression des images relatives aux noticdes
                    $img = JPATH_SITE.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'nemateria'.DIRECTORY_SEPARATOR.$entrepot.DIRECTORY_SEPARATOR.$d->id_notice.'.jpg';
                    $thumb = JPATH_SITE.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'nemateria'.DIRECTORY_SEPARATOR.$entrepot.DIRECTORY_SEPARATOR.$d->id_notice.'_thumb.jpg';

                    if(JFile::exists($img))
                    {
                        try
                        {
                            if( !JFile::delete($img) )
                            {
                                $error = "Le ".date('d/m/Y à H:i:s')." : \n";
                                $error .= "    Erreur dans la procédure d'effacement => \n    ".$doc->title." \n \n ";
                                throw new Exception($error);
                            }
                        }
                        catch (Exception $e)
                        {
                            _writeLog($e->getMessage());
                        }
                    }
                    if(JFile::exists($thumb))
                    {
                        try
                        {
                            if( !JFile::delete($thumb))
                            {
                                $error = "Le ".date('d/m/Y à H:i:s')." : \n";
                                $error .= "    Erreur dans la procédure d'effacement de la miniature => \n    ".$doc->title." \n \n ";
                                $error .= "    variables    ".$query." \n ";
                                $error .= "    variables    ".$img.$thumb." \n ";
                                throw new Exception($error);
                            }
                        }
                        catch (Exception $e)
                        {
                            _writeLog($e->getMessage());
                        }
                    }

                    //Préparation de la liste des id à supprimer
                    $ids_notices .= $d->id_notice.',';
                }

                try{
                    if($ids_notices != ""){
                        //On supprime le dernier caractere qui est une virgule
                        $ids_notices = substr($ids_notices,0,strlen($ids_notices)-1);
                        //Suppression des notices du set dans la bdd
                        $db =& JFactory::getDBO();
                        $query  = 'DELETE FROM #__nemateria_notices WHERE id_notice IN ('.$ids_notices.')';
                        $db->setQuery($query);
                        $db->execute($query);
                    }

                    $query  = 'DELETE FROM #__nemateria_contient WHERE id_collection = \''.$cid.'\'';
                    $db->setQuery($query);
                    $db->execute($query);

                    $query  = 'DELETE FROM #__nemateria_collections WHERE id_collection = \''.$cid.'\'';
                    $db->setQuery($query);
                    $db->execute($query);
                }
                catch (Exception $e){
                    return false;
                }
            }
        }

        return true;
    }
}
