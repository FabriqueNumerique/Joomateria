<?php

/**
 * @version		$Id: nemateria.php 01-01--2018 exlineo
 * @package		NEMATERIA v0.8
 * @subpackage	Component
 * @copyright	Copyright (C) 2018-today exlineo. All rights reserved.
 * @author		exlineo
 * @link		http://www.exlineo.com
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$ordering	= $listOrder=='ordering';
//var_dump($ordering);
?>
<tr>
	<th width="1%">
		<input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" />
	</th>
	<th>
		<?php echo JHtml::_('grid.sort', 'COM_NEMATERIA_NAME', 'name', $listDirn, $listOrder); ?>
	</th>
        <th>
		<?php echo JHtml::_('grid.sort', 'COM_NEMATERIA_HEADERS_COLLECTION_TITLE', 'title', $listDirn, $listOrder); ?>
	</th>
                <th>
		<?php echo JHtml::_('grid.sort', 'COM_NEMATERIA_HEADERS_CREATOR', 'creator', $listDirn, $listOrder); ?>
	</th>
        <th>
		<?php echo JText::_( 'COM_NEMATERIA_SUBMENU_NOTICES' ); ?>
	</th>

</tr>

