<?php

/**
 * @version		$Id: default_body.php 19 2011-03-28 19:29:57Z chdemko $
 * @package		l21oai25
 * @subpackage	Component
 * @copyright	Copyright (C) 2010-today Christophe Demko. All rights reserved.
 * @author		Christophe Demko
 * @link		http://joomlacode.org/gf/project/l21oai25/
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
//$user		= JFactory::getUser();
//$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$ordering 	= $this->state->get('list.ordering')=='ordering';
$n			= count($this->items);
?>
<?php foreach($this->items as $i => $item):
		$ordering	= ($listOrder == 'ordering'); ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php  echo JHtml::_('grid.id', $i, $item->id_entrepot); ?>
		</td>
		<td>
                    <a href="<?php echo JRoute::_('index.php?option=com_nemateria&task=entrepot.edit&id_entrepot='.$item->id_entrepot);?>">
			<?php echo $this->escape($item->title); ?></a>
		</td>
                <td class="center">
			<a href="index.php?option=com_nemateria&view=collections&filter_entrepot=<?php echo $item->id_entrepot;?>">
                            <?php echo '<img src="components/com_nemateria/assets/images/folder_green_mini.png" border="0">'; ?>
                        </a>
		</td>
		<td class="center">
			<?php echo $this->escape($item->url); ?>
		</td>
                <td class="center">
			<?php echo $this->escape($item->mail); ?>
		</td>
		<td>
			<?php echo $item->id_entrepot; ?>
		</td>
	</tr>
<?php endforeach; ?>

