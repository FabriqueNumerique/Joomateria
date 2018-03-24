<?php
/**
 * @version		$Id: search.php 14401 2010-01-26 14:10:00Z louis $
 * @package		Joomla
 * @subpackage	Search
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

//jimport('joomla.application.component.model');

/**
 * Search Component Search Model
 *
 * @package		Joomla
 * @subpackage	Search
 * @since 1.5
 */
class NemateriaModelRecherche extends JModelLegacy
{
	/**
	 * Sezrch data array
	 *
	 * @var array
	 */
	var $_data = null;

	/**
	 * Search total
	 *
	 * @var integer
	 */
	var $_total = null;

	/**
	 * Search areas
	 *
	 * @var integer
	 */
        var $_validSearchDate = null;

	/**
	 * Pagination object
	 *
	 * @var object
	 */
	var $_pagination = null;

	/**
	 * Constructor
	 *
	 * @since 1.5
	 */
	function __construct()
	{
		parent::__construct();

		$app = JFactory::getApplication();

		//Get configuration
		$config = JFactory::getConfig();

		// Get the pagination request variables
		$this->setState('limit', $app->getUserStateFromRequest('com_nemateria.limit', 'limit', $config->getValue('config.list_limit'), 'uint'));
		$this->setState('limitstart', JRequest::getUInt('limitstart', 0));

		// Set the search parameters
                //Set des paramètres de recherche avancés
                $keywordTitle		= urldecode(JRequest::getString('searchTitle'));
                $keywordArtiste		= urldecode(JRequest::getString('searchArtiste'));
                $keywordEditor		= urldecode(JRequest::getString('searchEditor'));
                $keywordSubject		= urldecode(JRequest::getString('searchSubject'));
                $keywordDescription	= urldecode(JRequest::getString('searchDescription'));
                $anneeFrom              = urldecode(JRequest::getInt('minDate'));
                $anneeUntil             = urldecode(JRequest::getInt('maxDate'));

		$match			= JRequest::getWord('searchphrase', 'all');
		$ordering		= JRequest::getWord('ordering', 'newest');
		$this->setSearch($keywordTitle, $keywordArtiste, $keywordEditor, $keywordSubject, $keywordDescription, $anneeFrom, $anneeUntil, $match, $ordering);

		//Set the search areas
		$areasT = JRequest::getVar('areasT');
		$this->setAreasT($areasT);
                //Set the search areas
		$areasF = JRequest::getVar('areasF');
		$this->setAreasF($areasF);

                $validSearchDate = JRequest::getVar('validSearchDate');
		$this->setValidSearchDate($validSearchDate); 
	}

	/**
	 * Method to set the search parameters
	 *
	 * @access	public
	 * @param string search string
 	 * @param string mathcing option, exact|any|all
 	 * @param string ordering option, newest|oldest|popular|alpha|category
	 */
	function setSearch($keywordTitle, $keywordArtiste, $keywordEditor, $keywordSubject, $keywordDescription, $anneeFrom, $anneeUntil, $match = 'all', $ordering = 'newest')
	{
		/*if(isset($keyword)) {
			$this->setState('keyword', $keyword);
		}*/
                /*Recherche avancé*/
                if(isset($keywordTitle)) {
			$this->setState('keywordTitle', $keywordTitle);
		}
                if(isset($keywordArtiste)) {
			$this->setState('keywordArtiste', $keywordArtiste);
		}
                if(isset($keywordEditor)) {
			$this->setState('keywordEditor', $keywordEditor);
		}
                if(isset($keywordSubject)) {
			$this->setState('keywordSubject', $keywordSubject);
		}
                if(isset($keywordDescription)) {
			$this->setState('keywordDescription', $keywordDescription);
		}
                //areaT
//                if(isset($areasT)) {
//			$this->setState('areasT', $areasT);
//		}
                // Ajout date
                if(isset($anneeFrom)) {
			$this->setState('anneeFrom', $anneeFrom);
		}
                if(isset($anneeUntil)) {
			$this->setState('anneeUntil', $anneeUntil);
		}
                /*Recherche avancé*/
		if(isset($match)) {
			$this->setState('match', $match);
		}

		if(isset($ordering)) {
			$this->setState('ordering', $ordering);
		}

	}

	/**
	 * Method to set the search areas
	 *
	 * @access	public
	 * @param	array	Active areas
	 * @param	array	Search areas
	 */
	function setAreasT($active = array(), $search = array())
	{
		$this->_areasT['active'] = $active;
		$this->_areasT['search'] = $search;
	}

        /**
	 * Method to set the search areas
	 *
	 * @access	public
	 * @param	array	Active areas
	 * @param	array	Search areas
	 */
	function setAreasF($active = array(), $search = array())
	{
                $this->_areasF['active'] = $active;
		$this->_areasF['search'] = $search;
	}


        function setValidSearchDate($active = array(), $search = array())
	{
                $this->_validSearchDate['active'] = $active;
		$this->_validSearchDate['search'] = $search;
	}

	/**
	 * Method to get weblink item data for the category
	 *
	 * @access public
	 * @return array
	 */
	function getData()
	{
            
                // Lets load the content if it doesn't already exist
		if (
                       empty($this->_data)
                        && ($this->getState('keywordTitle') != ""
                        || $this->getState('keywordArtiste') != ""
                        || $this->getState('keywordEditor') != ""
                        || $this->getState('keywordSubject') != ""
                        || $this->getState('keywordDescription') != ""
                        || $this->getState('anneeFrom') != 0
                        || $this->getState('anneeUntil') != 0
                        || $this->_areasT['active']
                        ))
		{
                    $areasT = $this->getAreasT();
                    $areasF = $this->getAreasF();
			
                        $validSearchDate = $this->getValidSearchDate();

			JPluginHelper::importPlugin( 'search');
			$dispatcher = JDispatcher::getInstance();
			$results = $dispatcher->trigger( 'onAdvl21oaiSearch', array(
                            $this->getState('keywordTitle'),
                            $this->getState('keywordArtiste'),
                            $this->getState('keywordEditor'),
                            $this->getState('keywordSubject'),
                            $this->getState('keywordDescription'),
                            $this->getState('anneeFrom'),
                            $this->getState('anneeUntil'),
                            $this->getState('match'),
                            $this->getState('ordering'),
                            $areasT['active'],
                            $areasF['active'],
                            $validSearchDate['active']) );
			 
			$rows = array();
			foreach($results AS $result) {
				$rows = array_merge( (array) $rows, (array) $result);

			}

			$this->_total	= count($rows);
			if($this->getState('limit') > 0) {
				$this->_data    = array_splice($rows, $this->getState('limitstart'), $this->getState('limit'));
			} else {
				$this->_data = $rows;
			}
		}
		
            return $this->_data;
	}

	/**
	 * Method to get the total number of weblink items for the category
	 *
	 * @access public
	 * @return integer
	 */
	function getTotal()
	{
		return $this->_total;
	}

	/**
	 * Method to get a pagination object of the weblink items for the category
	 *
	 * @access public
	 * @return integer
	 */
	function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}

		return $this->_pagination;
	}

	/**
	 * Method to get the search areas
	 *
	 * @since 1.5
	 */
	function getAreasT()
	{
		global $app;

		// Load the Category data
		if (empty($this->_areasT['search']))
		{
			$areas = array();

			//JPluginHelper::importPlugin( 'search');
                        JPluginHelper::importPlugin( 'nemateria');
			$dispatcher =& JDispatcher::getInstance();
			$searchareas = $dispatcher->trigger( 'onSearchAreas' );


			foreach ($searchareas as $area) {
				$areas = array_merge( $areas, $area );
                                //echo "le dispatcher : ".$area.'<br/>';
                                 foreach ($areas as $ar) {

                                //echo "le merge : ".$ar.'<br/>';
                                }
			}

			$this->_areasT['search'] = $areas;
		}

		return $this->_areasT;
	}

        function getAreasF()
	{
		global $app;

		// Load the Category data
		if (empty($this->_areasF['search']))
		{
			$areas = array();

			//JPluginHelper::importPlugin( 'search');
                        JPluginHelper::importPlugin( 'nemateria');
			$dispatcher =& JDispatcher::getInstance();
			$searchareas = $dispatcher->trigger( 'onSearchAreas' );


			foreach ($searchareas as $area) {
				$areas = array_merge( $areas, $area );
                                echo "le dispatcher : ".$area.'<br/>';
                                 foreach ($areas as $ar) {

                                echo "le merge : ".$ar.'<br/>';
                                }
			}

			$this->_areasF['search'] = $areas;
		}

		return $this->_areasF;
	}

        function getValidSearchDate()
	{
		global $app;

		// Load the Category data
		if (empty($this->_validSearchDate['search']))
		{
			$areas = array();

			//JPluginHelper::importPlugin( 'search');
                        JPluginHelper::importPlugin( 'nemateria');
			$dispatcher =& JDispatcher::getInstance();
			$searchareas = $dispatcher->trigger( 'onSearchAreas' );


			foreach ($searchareas as $area) {
				$areas = array_merge( $areas, $area );
                                echo "le dispatcher : ".$area.'<br/>';
                                 foreach ($areas as $ar) {

                                echo "le merge : ".$ar.'<br/>';
                                }
			}

			$this->_validSearchDate['search'] = $areas;
		}

		return $this->_validSearchDate;
	}


        function _miniature($imgsource, $titre)
        {
        $image_dir = 'components/com_nemateria/miniatures/';
        // Définition du nom de la miniature
        $miniature = $image_dir."mini_".$titre.".jpg";
        // Définition de la largeur et de la hauteur maximale
        $width = 200;
        $height = 200;

        // si l'image qu'on lit est déjà une miniature
        // on applique pas la fonction
        if (strstr($imgsource,"mini_")) {
                return false;
        }

        // si la miniature n'est pas déjà créée
        // (sinon on la réutilise)
        if (!file_exists($miniature))
        {
                // Cacul des nouvelles dimensions proportionnelles
                if((list($width_src, $height_src) = getimagesize($imgsource)))
                {

                    if ($width && ($width_src < $height_src))
                    {
                        $width = ($height / $height_src) * $width_src;
                    }
                    else
                    {
                        $height = ($width / $width_src) * $height_src;
                    }

                    // créé une image vide
                    $im = ImageCreateTrueColor ($width, $height) or die ("Erreur pour créer l'image");

                    // lit l'image source
                    $source = ImageCreateFromJpeg($imgsource);

                    $blanc = ImageColorAllocate ($im, 255, 255, 255);
                    // créé la miniature : attention fonction lourde
                    ImageCopyResampled($im, $source, 0, 0, 0, 0, $width, $height, $width_src, $height_src);

                    // sauvegarde du résultat
                    ImageJpeg($im, $miniature);
                }
                else
                {
                    return false;
                }
            }
        }
        
}
