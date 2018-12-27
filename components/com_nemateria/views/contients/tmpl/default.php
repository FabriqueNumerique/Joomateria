<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

?>
<div class="componentheading<?php echo $this->escape($this->get('pageclass_sfx')); ?>"><h2><?php echo $this->params->get('page_title');  ?></h2></div>

<div class="contentpane">
	<h3>Some Items, if present</h3>
	<ul>
<?php foreach ($this->items as $i => $item) : 
				//you may want to do this anywhere else					
				$link = JRoute::_('index.php?option=com_nemateria&view=contient&id='. $item->id_notice);
	?>
	<li><a href="<?php echo $link ?>"><?php  echo $item->id_notice ?></a></li>
<?php endforeach; ?>
</ul>		
</div>
 