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
// import de la librairie model de joomla
jimport( 'joomla.application.component.model' );

// import the joomla language library
//jimport('joomla.language.helper');

// import component helper
JLoader::register('NemateriaHelper', JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_nemateria' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'nemateria.php');

/**
 * Sets Model of L21oai25 component
 */
class NemateriaModelNotices extends JModelList
{
    // Set the authorized ordering fields
    protected $filter_fields = array('title','locked');

    /**
     * Constructor.
     *
     * @param	array	$config An optional associative array of configuration settings.
     * @see		JController
     */
    public function __construct($config = array())
    {
        parent::__construct($config);

        $filter_set = JRequest::getInt('filter_set', 0);

        //print_r($filter_set);

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
        parent::populateState('title', 'asc');
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
        $query->select('*');

        // From the l21oai25_sets table
        $query->from('#__nemateria_notices as e');

        // Filter by search in title
        if ($search = $this->getState('filter.search'))
        {
            $search = $db->Quote('%' . $db->escape($search, true) . '%');
            $query->where('(title LIKE ' . $search . ')');
        }
        if($filter_collection= JRequest::getCmd( 'filter_set' ))
        {
            $query->where('id_notice IN (select id_notice from #__nemateria_contient where id_collection ='.$filter_collection.')' );
        }
//                // Add the list ordering clause.
        $ordering = $this->getState('list.ordering','e.title');
        $direction = $this->getState('list.direction','desc');

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
        $notices = $this->getStoreId();

        // Try to load the data from internal storage.
        if (!empty($this->cache[$notices]))
        {
            return $this->cache[$notices];
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
            //$filter=$this->_buildContentFilter();
            //$query->where($filter);
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
        $this->cache[$notices] = $items;
        return $this->cache[$notices];
    }

    /**
     * delete() Méthode de suppression d'une notice de la bdd, supprime aussi ses liens vers les collections
     *
     * @author		Mathieu Roulland
     * @author		Marc Roulon
     * @author		Mathieu Pipet
     *
     * @access public
     *
     * @return mixed true si tout c'est bien passé ou un message d'erreur
     */
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
                $queryI  = 'SELECT DISTINCT records.id_notice, entrepots.id_entrepot ';
                $queryI .= 'FROM ';
                $queryI .= '#__nemateria_notices as notices ';
                $queryI .= 'JOIN ';
                $queryI .= '#__nemateria_contient as contient ';
                $queryI .= 'ON notices.id_notice = contient.id_notice ';
                $queryI .= 'JOIN ';
                $queryI .= '#__nemateria_collections as collections ';
                $queryI .= 'ON contient.id_collection = collections.id_collection ';
                $queryI .= 'JOIN ';
                $queryI .= '#__nemateria_entrepots as entrepots ';
                $queryI .= 'ON collections.id_entrepot = entrepots.id_entrepot ';
                $queryI .= 'WHERE notices.id_notice = '.$cid;

                $db->setQuery($queryI);
                $doc = $db->loadRow();
                // => Supression des images associé à la notice
                $img = JPATH_SITE.DS.'images'.DS.'nemateria'.DS.$doc[1].DS.$doc[0].'.jpg';
                $thumb = JPATH_SITE.DS.'images'.DS.'nemateria'.DS.$doc[1].DS.$doc[0].'_thumb.jpg';

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

                try{
                    $db =& JFactory::getDBO();
                    $query  = 'DELETE FROM #__nemateria_notices WHERE id_notice = \''.$cid.'\'';

                    $db->setQuery($query);
                    $db->execute($query);

                    $query  = 'DELETE FROM #__nemateria_contient WHERE id_notice = \''.$cid.'\'';

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

    function getAllCollections()
    {
        $query='SELECT * FROM #__nemateria_collections order by spec asc';
        $this->_db->setQuery($query);
        $collections=$this->_db->loadObjectList();
        return $collections;

        // Create a new query object.
        /*$db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__l21_oai25_sets');
        $query->order('name asc');

        $db->setQuery($query);
        $sets = $db->execute($query);
        return $sets;*/
    }
    /*function _buildContentFilter()
    {
        //global $mainframe,$option;
        $mainframe = JFactory::getApplication();
        $option = JRequest::getCmd('option');

        $context                        = 'com_l21oai25.records';
        $filter_set                 = $mainframe->getUserStateFromRequest($context.'filter_set','filter_set','','string');
        $search                         = $mainframe->getUserStateFromRequest($context.'search','search','','string');
        $search                         = JString::strtolower($search);

        $where=array();

        if($filter_set)
        {
            $where[]='id_ter in (select id_set from #__l21_oai25_sets as t inner join #__l21_oai25_contient as r on t.id_set=r.id_set where id_set='.$filter_set.')';
        }

        if($search)
        {
            $where[]='LOWER (name) LIKE '.$this->_db->Quote('%'.$this->_db->getEscaped($search,true).'%',false);

        }
        $filter=count($where) ? ' AND '.implode(' AND ',$where):'';

        return $filter;
    }*/
}
