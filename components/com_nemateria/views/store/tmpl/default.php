<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>"><h2><?php echo $this->params->get('page_title');  ?></h2></div>
<h3><?php echo $this->item->title; ?></h3>
<div class="contentpane">
	<div><h4>Some interesting informations</h4></div>
		<div>
		Id_store: <?php echo $this->item->id_entrepot; ?>
	</div>
		
		<div>
		Title: <?php echo $this->item->title; ?>
	</div>
		
		<div>
		Description: <?php echo $this->item->description; ?>
	</div>
		
		<div>
		Url: <?php echo $this->item->url; ?>
	</div>
		
		<div>
		Mail: <?php echo $this->item->mail; ?>
	</div>
		
		<div>
		Granularity: <?php echo $this->item->granularity; ?>
	</div>
		
		<div>
		EarliestDatestamp: <?php echo $this->item->earliestDatestamp; ?>
	</div>
		
		<div>
		Identifier: <?php echo $this->item->identifier; ?>
	</div>
		
		<div>
		Config: <?php echo $this->item->config; ?>
	</div>
		
		<div>
		Id_store: <?php echo $this->item->id_entrepot; ?>
	</div>
		
	</div>
 