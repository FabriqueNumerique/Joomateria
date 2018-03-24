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

