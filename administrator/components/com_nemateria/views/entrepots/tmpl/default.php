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

// load tooltip behavior
JHtml::_('behavior.tooltip');

//$listOrder	= $this->escape($this->state->get('list.ordering'));
//$listDirn	= $this->escape($this->state->get('list.direction'));
?>
<section id="nemateriaAdmin">
	<form action="<?php echo JRoute::_('index.php?option=com_nemateria&view=entrepots'); ?>" method="post" name="adminForm" id="adminForm">
		<table>
			<tr>
				<td>
				<?php echo $this->loadTemplate('filter');?>
				</td>
			</tr>
		</table>
		<table class="adminlist">
			<thead><?php echo $this->loadTemplate('head');?></thead>
			<tfoot><?php echo $this->loadTemplate('foot');?></tfoot>
			<tbody><?php echo $this->loadTemplate('body');?></tbody>
		</table>
		<div>
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
			<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</section>
