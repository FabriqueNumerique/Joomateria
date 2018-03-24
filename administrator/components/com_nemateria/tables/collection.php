<?php

/**
 * @version		$Id: l21oai.php 9 2012-02-14  labxxi $
 * @package		L21OAI v2.5
 * @subpackage	Component
 * @copyright	Copyright (C) 2010-today Labxxi. All rights reserved.
 * @author		Labxxi
 * @link		http://labxxi.com
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
	
}
