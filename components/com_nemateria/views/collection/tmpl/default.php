<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>"><h2><?php echo $this->params->get('page_title');  ?></h2></div>
<h3><?php echo $this->item->title; ?></h3>
<div class="contentpane">
	<div><h4>Quelques informations intéréssantes</h4></div>
		<div>
		Id_collection: <?php echo $this->item->id_collection; ?>
	</div>
		
		<div>
		Titre: <?php echo $this->item->title; ?>
	</div>
		
		<div>
		Description: <?php echo $this->item->description; ?>
	</div>
		
		<div>
		Id_entrepot: <?php echo $this->item->id_store; ?>
	</div>
		
		<div>
		Spec: <?php echo $this->item->spec; ?>
	</div>
		
		<div>
		Nom: <?php echo $this->item->name; ?>
	</div>
		
		<div>
		Createur: <?php echo $this->item->creator; ?>
	</div>
		
		<div>
		Autre_langage: <?php echo $this->item->other_langage; ?>
	</div>
		
		<div>
		Type: <?php echo $this->item->type; ?>
	</div>
		
		<div>
		Id_collection: <?php echo $this->item->id_collection; ?>
	</div>
		
	</div>
 