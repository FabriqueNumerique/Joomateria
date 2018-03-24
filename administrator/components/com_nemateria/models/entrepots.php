<?php

/**
 * @version		$Id: view.html.php 42 2011-03-31 09:12:23Z chdemko $
 * @package		Nemateria
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
 * Store Model of Nemateria component
 */
class NemateriaModelEntrepots extends JModelList
{
    // Set the authorized ordering fields
    protected $filter_fields = array('title', 'url', 'mail');

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
//		NemateriaHelper::createTitleTables($tags);
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
        parent::populateState('title', $direction);
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
        $query->select('
			e.id_entrepot		AS id_entrepot,
			e.title			AS title,
			e.url			AS url,
			e.mail			AS mail,
			e.granularity		AS granularity,
			e.earliestDatestamp	AS earliestDatestamp,
			e.description		AS description,
			e.identifier            AS identifier,
			e.config		AS config
		');

        // From the nemateria_entrepot table
        $query->from('#__nemateria_entrepots AS e');

        // Filter by search in title
        if ($search = $this->getState('filter.search'))
        {
            $search = $db->Quote('%' . $db->escape($search, true) . '%');
            $query->where('(title LIKE ' . $search . ')');
        }

        // Add the list ordering clause.
        $ordering = $this->getState('list.ordering', 'e.title');
        $direction = $this->getState('list.direction', 'desc');

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
        $entrepots = $this->getStoreId();

        // Try to load the data from internal storage.
        if (!empty($this->cache[$entrepots]))
        {
            return $this->cache[$entrepots];
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

            $db->setQuery($query);

            if ($db->getErrorNum())
            {
                $this->setError($db->getErrorMsg());
                return false;
            }
        }

        // Add the items to the internal cache.
        $this->cache[$entrepots] = $items;

        return $this->cache[$entrepots];
    }
}
