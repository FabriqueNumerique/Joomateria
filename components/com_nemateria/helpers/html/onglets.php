<article id="infos" data="<?php echo $this->item->id_notice; ?>">
	<?php // if($vars['relation']): ?>
		<!-- <div id="ressource-doc"><a href="<?php // echo $vars['pdf']; ?>" rel="lightbox" target="_blank" ><img src="<?php // echo(JURI::base());?>components/com_exlineo/assets/images/media_texte.png" /></a></div>-->
    <?php // endif; ?>
     	<div class="tabs">
            <ul class="tab-links">
              <li class="active"><a href="#media_<?php echo $this->item->id_notice; ?>">Informations</a></li>
            <?php if(strlen($this->item->relation) > 0 && ctype_digit($this->item->relation)): ?>
              <li><a href="#collection_<?php echo $this->item->id_notice; ?>">Notes</a></li>
            <?php endif; ?>
              <li><a href="#commenter_<?php echo $this->item->id_notice; ?>">Contribuez</a></li>
            </ul>
              <!-- -->
            <div class="tab-content">
                <div id="media_<?php echo $this->item->id_notice; ?>" class="tab active">
                      <div class="infos">
                        <?php
                          echo strrpos($this->item->description, '\n');
                          echo str_replace('\n', '<br />', $this->item->description);
                        ?>
                      </div>
                      <br />
                      <div class="infos">
                      	<?php include_once(JPATH_COMPONENT.'/helpers/html/metadonnees.php'); ?>
                      </div>    
                </div>
                <div id="collection_<?php echo $this->item->id_notice; ?>" class="tab" style="display: none;">
                    <?php echo $this->item->relation; ?>
                 </div>
                <div id="commenter_<?php echo $this->item->id_notice; ?>" class="tab" style="display: none;">
                    <?php include_once(JPATH_COMPONENT.'/helpers/html/forms/contribuer.php'); ?>
                </div>
            <!-- -->
            </div>
        </div>
      </article>