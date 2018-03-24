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
defined('_JEXEC') or die('Restricted Access');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$ordering	= $listOrder=='ordering';
?>
<tr>
	<th width="1%">
		<input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" />
	</th>   
	<th>
		<?php echo JHtml::_('grid.sort', 'COM_NEMATERIA_HEADERS_TITLE', 'title', $listDirn, $listOrder); ?>
	</th>
        <th>
		<?php echo JText::_(  'COM_NEMATERIA_SUBMENU_COLLECTIONS' ); ?>
	</th>
	<th>
		<?php echo JHtml::_('grid.sort', 'COM_NEMATERIA_HEADERS_URL_ENTREPOT', 'url', $listDirn, $listOrder); ?>
	</th>
        <th>
		<?php echo JHtml::_('grid.sort', 'COM_NEMATERIA_HEADERS_MAIL_ENTREPOT', 'mail', $listDirn, $listOrder); ?>
	</th>
</tr>

