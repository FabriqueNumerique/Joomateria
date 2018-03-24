<?php


defined('_JEXEC') or die('Restricted access');
 
 ?>

<?php if ( $this->params->get( 'show_page_title', 0 ) ) : ?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<?php echo $this->params->get( 'page_title' ); ?>
</div>
<?php endif; ?>
<?php echo count($this->results); ?>
<?php echo $this->loadTemplate('form'); ?>
<?php if($this->error==null && count($this->results) > 0) :
	echo $this->loadTemplate('results');
else :
	echo $this->loadTemplate('error');
endif; ?>
