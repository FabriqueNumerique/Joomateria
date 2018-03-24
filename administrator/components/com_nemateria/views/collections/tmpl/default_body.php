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
//$user		= JFactory::getUser();
//$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$ordering 	= $this->state->get('list.ordering')=='ordering';
$n			= count($this->items);
?>
<?php foreach($this->items as $i => $item):
		$ordering	= ($listOrder == 'ordering');
//		$canCreate	= $user->authorise('core.create',		'com_dictionary.category.'.$item->catid);
//		$canEdit	= $user->authorise('core.edit',			'com_dictionary.entry.'.$item->id);
//		$canCheckin	= $user->authorise('core.manage',		'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
//		$canEditOwn	= $user->authorise('core.edit.own',		'com_dictionary.entry.'.$item->id) && $item->created_by == $userId;
//		$canChange	= $user->authorise('core.edit.state',	'com_dictionary.entry.'.$item->id) && $canCheckin;
?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo JHtml::_('grid.id', $i, $item->id_collection); ?>
		</td>
		<td>
                    <a href="<?php echo JRoute::_('index.php?option=com_nemateria&task=collection.edit&id_collection='.$item->id_collection);?>">
			<?php echo $this->escape($item->name); ?></a>
			
		</td>
                <td>
                    <a href="<?php echo JRoute::_('index.php?option=com_nemateria&task=collection.edit&id_collection='.$item->id_collection);?>">
			<?php echo $this->escape($item->title); ?></a>
			
		</td>
                <td>
                    <a href="<?php echo JRoute::_('index.php?option=com_nemateria&task=collection.edit&id_collection='.$item->id_collection);?>">
			<?php echo $this->escape($item->creator); ?></a>
			
		</td>
                 <td class="center">
			<a href="index.php?option=com_nemateria&view=notices&filter_collection=<?php echo $item->id_collection;?>">
                            <?php echo '<img src="components/com_nemateria/assets/images/folder_grey_mini.png" border="0">'; ?>
                        </a>
		</td>
	</tr>
<?php endforeach; ?>

