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

// Récupérer l'id de la collection à afficher pour la réatribuer
$id_collection = '';
$jinput = JFactory::getApplication()->input;

if($jinput->get('filter_collection', '', 'INT')){
	$id_collection = "&filter_collection=".$jinput->get('filter_collection', 'default_value', 'filter');
}

?>
<?php foreach($this->items as $i => $item):
		$ordering	= ($listOrder == 'ordering');
?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo JHtml::_('grid.id', $i, $item->id_notice); ?>
		</td>
		<td>
                    <a href="<?php echo JRoute::_('index.php?option=com_nemateria&task=notice.edit&id_notice='.$item->id_notice.$id_collection);?>">
			<?php echo $this->escape($item->title); ?></a>
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

