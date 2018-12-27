<?php
defined('_JEXEC') or die;
?>
<div class="item-page collections">
    <?php

    if(empty($this->collection)) { ?>
        <?php  ?>
        <p><?php echo JText::_('COM_NEMATERIA_NO_COLLECTION_FOUND'); ?></p>
        <?php
    }
    else {
        foreach($this->collection as $c=>$collection){
            $link = JRoute::_('index.php?option=com_nemateria&view=collection&id='. $collection->id_collection);
            ?>
            <li><a href="<?php echo $link?>"><?php echo "$c : $collection->title;" ?></a> </li>
            <?php
        }
    }
    ?>
</div>