<article id="infos" class="droite moitier" data="<?php echo $this->item->id_notice; ?>">
	<?php // if($vars['relation']): ?>
		<!-- <div id="ressource-doc"><a href="<?php // echo $vars['pdf']; ?>" rel="lightbox" target="_blank" ><img src="<?php // echo(JURI::base());?>components/com_exlineo/assets/images/media_texte.png" /></a></div>-->
    <?php // endif; ?>
     	<div class="tabs">
            <ul class="tab-links">
              <li class="active"><a href="#media_<?php echo $this->item->id_notice; ?>">Informations</a></li>
              <li><a href="#collection_<?php echo $this->item->id_notice; ?>">Notes</a></li>
              <li><a href="#commenter_<?php echo $this->item->id_notice; ?>">Contribuez</a></li>
            </ul>
              <!-- -->
            <div class="tab-content">
                <div id="media_<?php echo $this->item->id_notice; ?>" class="tab active">
                      <div class="infos">
                          <?php echo $this->item->description; ?>
                      </div>
                      <br />
                      <div class="infos">
                         <?php include_once(JPATH_ROOT.DS.'components/com_exlineo/assets/lib/valeurs_bdd.php'); ?>
                      </direquire(JPATH_COMPONENT_SITE . '/views/notice/tmpl/utils/onglets.php');v>    
                </div>
                <div id="collection_<?php echo $this->item->id_notice; ?>" class="tab" style="display: none;">
                    <?php echo $this->item->relation; ?>
                 </div>
                <div id="commenter_<?php echo $this->item->id_notice; ?>" class="tab" style="display: none;">
                    {rsform 3}
                    <script language="javascript" type="text/javascript">
						jQuery(".formBody #Notice").val('<?php echo rtrim ($liens[0]); ?>');
					</script>
                </div>
            <!-- -->
            </div>
        </div>
      </article>