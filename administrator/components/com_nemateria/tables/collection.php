<?php

/**
 * @version		$Id: nemateria.php 01-01--2018 exlineo
 * @package		NEMATERIA v0.8
 * @subpackage	Component
 * @copyright	Copyright (C) 2010-today Labxxi. All rights reserved.
 * @author		exlineo
 * @link		http://www.exlineo.com
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

// import Joomla table library
jimport('joomla.database.table');

/**
 * Entry Table class of l21oai25 component
 */
class NemateriaTableCollection extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 *
	 * @note	Overload JTable::__construct
	 */
	public function __construct(&$db) 
	{
		parent::__construct('#__nemateria_collections', 'id_collection', $db);
	}

    public function bind($array, $ignore = '')
    {

        return parent::bind($array, $ignore);
    }

    /**
     * Overloaded check method to ensure data integrity
     *
     * @access public
     * @return boolean True on success
     * @since 1.0
     */
    public function check()
    {



        /** check for valid name */
        /**
        if (trim($this->title) == '') {
        $this->setError(JText::_('Your Set must contain a title.'));
        return false;
        }
         **/

        return true;
    }
}
