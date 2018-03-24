<?php
	// no direct access
	defined('_JEXEC') or die('Restricted access');
	require_once(JPATH_ROOT.DS.'components/com_exlineo/assets/lib/actions.php'); 
?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>"><h2><?php echo $this->params->get('page_title');  ?></h2></div>
<h3><?php echo $this->item->title; ?></h3>
<div class="contentpane">
<?php $type = gere_type('image'); ?>
		<div>
		Id_record: <?php echo $this->item->id_record; ?>
	</div>
		<div>
		Alias: <?php echo $this->item->alias; ?>
	</div>
		
		<div>
		Description: <?php echo $this->item->description; ?>
	</div>
		
		<div>
		Published: <?php echo $this->item->published; ?>
	</div>
		
		<div>
		Language: <?php echo $this->item->language; ?>
	</div>
		
		<div>
		Creator: <?php echo $this->item->creator; ?>
	</div>
		
		<div>
		Subject: <?php echo $this->item->subject; ?>
	</div>
		
		<div>
		Publisher: <?php echo $this->item->publisher; ?>
	</div>
		
		<div>
		Contributor: <?php echo $this->item->contributor; ?>
	</div>
		
		<div>
		Date: <?php echo $this->item->date; ?>
	</div>
		
		<div>
		Type: <?php echo $this->item->type; ?>
	</div>
		
		<div>
		Format: <?php echo $this->item->format; ?>
	</div>
		
		<div>
		Identifier: <?php echo $this->item->identifier; ?>
	</div>
		
		<div>
		Source: <?php echo $this->item->source; ?>
	</div>
		
		<div>
		Relation: <?php echo $this->item->relation; ?>
	</div>
		
		<div>
		Coverage: <?php echo $this->item->coverage; ?>
	</div>
		
		<div>
		Rights: <?php echo $this->item->rights; ?>
	</div>
		
		<div>
		Champs: <?php echo $this->item->champs; ?>
	</div>
		
		<div>
		Datestamp: <?php echo $this->item->datestamp; ?>
	</div>
		
		<div>
		Id_header: <?php echo $this->item->id_header; ?>
	</div>
		
		<div>
		Locked: <?php echo $this->item->locked; ?>
	</div>
		
		<div>
		Record_langage: <?php echo $this->item->record_langage; ?>
	</div>
		
		<div>
		Metadata: <?php echo $this->item->metadata; ?>
	</div>
		
		<div>
		Unique_identifier: <?php echo $this->item->unique_identifier; ?>
	</div>
		
		<div>
		Local_link: <?php echo $this->item->local_link; ?>
	</div>
		
		<div>
		Id_record: <?php echo $this->item->id_record; ?>
	</div>
		
	</div>
 