<?php
defined('_JEXEC') or die('Restricted access'); 
//print_r($this->results);
?>
<h1>Résultats</h1>
<?php //print_r($this->results); ?>
<dl class="search-results<?php //echo $this->pageclass_sfx; ?>">
<?php foreach($this->results as $result) : ?>
	<dt class="result-title">
		<?php //echo $this->pagination->limitstart + $result->count.'. ';?>
                <?php if ($result->href) :?>
			<a href="<?php echo JRoute::_($result->href); ?>" target="_self">
			<?php echo '<h2>'.$this->escape($result->title).'</h2>';?>
                            </a>
		<?php else:?>
			<?php echo $this->escape($result->title);?>
		<?php endif; ?>
	</dt>
	<dd class="result-text">
		<?php echo $result->description; ?>
	</dd>
<?php endforeach; ?>
</dl>

<div class="pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
