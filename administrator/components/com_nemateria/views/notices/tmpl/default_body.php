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
		$ordering	= ($listOrder == 'ordering');
//		$canCreate	= $user->authorise('core.create',		'com_l21oai25.category.'.$item->catid);
//		$canEdit	= $user->authorise('core.edit',			'com_l21oai25.entry.'.$item->id);
//		$canCheckin	= $user->authorise('core.manage',		'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
//		$canEditOwn	= $user->authorise('core.edit.own',		'com_l21oai25.entry.'.$item->id) && $item->created_by == $userId;
//		$canChange	= $user->authorise('core.edit.state',	'com_l21oai25.entry.'.$item->id) && $canCheckin;
?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo JHtml::_('grid.id', $i, $item->id_notice); ?>
		</td>
		<td>
                    <a href="<?php echo JRoute::_('index.php?option=com_nemateria&task=notice.edit&id_notice='.$item->id_notice);?>">
			<?php echo $this->escape($item->title); ?></a>
			<p class="smallsub">
		</td>
		<td>
			<?php echo JHtml::_('jgrid.published', $item->published, $i, 'records.', 'cb'); ?>
		</td>
                <td>
			<?php
                            if($item->locked == 0)
                            {
                            ?>
                                <img src="components/com_nemateria/assets/images/unlock.png" alt="unlock" title="unlock" />
                            <?php 
                            }
                            else
                            {
                            ?>
                                <img src="components/com_nemateria/assets/images/locked.png" alt="lock" title="lock" />
                            <?php 
                            }
                        ?>
		</td>
	</tr>
<?php endforeach; ?>

