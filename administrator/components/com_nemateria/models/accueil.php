<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modeladmin library
jimport('joomla.application.component.modeladmin');


/**
 * Entry Controller of Dictionary component
 */
class nemateriaModelAccueil extends JModelList
{
    
	var $_total = null;
    var $_pagination = null;
    function __construct()
    {
        parent::__construct();
    }
    function getStates()
    {
		$states = new JObject();
        $db = JFactory::getDBO();
        $query = 'select count( id_entrepot ) from #__nemateria_entrepots';
        $db->setQuery( $query );
        $states->entrepots = $db->loadResult();

        $query = 'select count( id_collection ) from #__nemateria_collections';
        $db->setQuery( $query );
        $states->collections = $db->loadResult();

        $query = 'select count( id_notice ) from #__nemateria_notices';
        $db->setQuery( $query );
        $states->notices = $db->loadResult();

//        $query = 'select count( * ) from #__l21_oai_ressources';
//        $db->setQuery( $query );
//        $states->ressources = $db->loadResult();
		
		
		return $states;
	
	}
	
	function getEntrepots()
	{
                $db = JFactory::getDBO();
		$query = 'select title, id_entrepot from #__nemateria_entrepots order by id_entrepot desc limit 5';
		$db->setQuery( $query );
		$entrepots = $db->loadObjectList();
		
		return $entrepots;
	
	}
	
	function getCollections()
	{
	        $db = JFactory::getDBO();
		$query = 'select name, id_collection from #__nemateria_collections order by id_collection desc limit 5';
		$db->setQuery( $query );
		$collections = $db->loadObjectList();
		
		return $collections;
		
	}
	
	function getNotices()
	{
                $db = JFactory::getDBO();
		$query = 'select title, id_notice from #__nemateria_notices order by id_notice desc limit 5';
		$db->setQuery( $query );
		$notices = $db->loadObjectList();
		
		return $notices;
	
	}

}
