<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();

/*$document->addScriptOptions('mod_example', array(
    'series_images' => json_encode(implode(array_map('trim', array_values($themes)), ",")),
    'sliderOptions' => array('selector' => '.my-slider', 'timeout' => 300, 'fx' => 'fade')
));*/

?>

<div class="componentheading<?php echo $this->escape($this->get('pageclass_sfx')); ?>"><h2><?php echo $this->params->get('page_title');  ?></h2></div>

<main id="recherche">
    
    
</main>