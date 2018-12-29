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
class NemateriaTableNotice extends JTable
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
		parent::__construct('#__nemateria_notices', 'id_notice', $db);
	}
	
}
