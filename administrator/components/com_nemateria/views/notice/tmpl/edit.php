<?php

/**
 * @version		$Id: edit.php 12 2011-03-24 11:22:01Z chdemko $
 * @package		nemateria
 * @subpackage	Component
 * @copyright	Copyright (C) 2010-today Christophe Demko. All rights reserved.
 * @author		Christophe Demko
 * @link
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>
<section id="nemateriaAdmin">
<form action="<?php echo JRoute::_('index.php?option=com_nemateria&layout=edit&id_notice='.(int) $this->item->id_notice); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
        <fieldset class="adminform" name="detail" label="detail">
            <legend><?php echo  JText::_('COM_NEMATERIA_DETAILS', $this->item->id_notice); ?></legend>
            <ul class="adminformlist">


                <li><?php echo $this->form->getLabel('published'); ?>
                    <?php echo $this->form->getInput('published'); ?></li>

                <li><?php echo $this->form->getLabel('locked'); ?>
                    <?php echo $this->form->getInput('locked'); ?></li>

                <li><?php echo $this->form->getLabel('id_collection');

                    $default = $this->item->selectedCollections;
                    $options = array();
                    foreach($this->item->collections as $collections){
                        $options[] = JHTML::_('select.option', $collections->id_collection, $collections->name);
                    }
                    $list = JHTML::_('select.genericlist', $options, 'jform[id_collection][]', 'class="'. $collections->id_collection.'" id="jform_id_collection" multiple="multiple"', 'value', 'text', $default);
                    echo $list;
                    ?></li>

                <li><?php echo $this->form->getLabel('title'); ?>
                    <?php echo $this->form->getInput('title'); ?></li>

                <li><?php echo $this->form->getLabel('alias'); ?>
                    <?php echo $this->form->getInput('alias'); ?></li>

                <li><?php echo $this->form->getLabel('unique_identifier'); ?>
                    <?php echo $this->form->getInput('unique_identifier'); ?></li>

                <li><?php echo $this->form->getLabel('creator'); ?>
                    <?php echo $this->form->getInput('creator'); ?></li>


                <li><?php echo $this->form->getLabel('subject'); ?>
                    <?php echo $this->form->getInput('subject'); ?></li>

                <li><?php echo $this->form->getLabel('type'); ?>
                    <?php echo $this->form->getInput('type'); ?></li>

                <li><?php echo $this->form->getLabel('description'); ?>
                    <?php echo $this->form->getInput('description'); ?></li>

                <li><?php echo $this->form->getLabel('publisher'); ?>
                    <?php echo $this->form->getInput('publisher'); ?></li>

                <li><?php echo $this->form->getLabel('contributor'); ?>
                    <?php echo $this->form->getInput('contributor'); ?></li>

                <li><?php echo $this->form->getLabel('date'); ?>
                    <?php echo $this->form->getInput('date'); ?></li>

                <li><?php echo $this->form->getLabel('format'); ?>
                    <?php echo $this->form->getInput('format'); ?></li>

                <li><?php echo $this->form->getLabel('identifier'); ?>
                    <?php echo $this->form->getInput('identifier'); ?></li>

                <li><?php echo $this->form->getLabel('source'); ?>
                    <?php echo $this->form->getInput('source'); ?></li>
				</ul>
				<ul class="adminformlist">
                <li><?php echo $this->form->getLabel('language'); ?>
                    <?php echo $this->form->getInput('language'); ?></li>

                <li><?php echo $this->form->getLabel('relation'); ?>
                    <?php echo $this->form->getInput('relation'); ?></li>

                <li><?php echo $this->form->getLabel('coverage'); ?>
                    <?php echo $this->form->getInput('coverage'); ?></li>

                <li><?php echo $this->form->getLabel('rights'); ?>
                    <?php echo $this->form->getInput('rights'); ?></li>

                <li><?php echo $this->form->getLabel('datestamp'); ?>
                    <?php echo $this->form->getInput('datestamp'); ?></li>

                <li><?php echo $this->form->getLabel('metadata'); ?>
                    <?php echo $this->form->getInput('metadata'); ?></li>

                <li><?php echo $this->form->getLabel('champs'); ?>
                    <?php echo $this->form->getInput('champs'); ?></li>

                <li><?php echo $this->form->getLabel('id_notice'); ?>
                    <?php echo $this->form->getInput('id_notice'); ?></li>
			</ul>
                <div class="clr"></div>
        </fieldset>
        <fieldset class="adminform" name="ressource" label="ressource">
            <legend><?php echo  JText::_('COM_NEMATERIA_RESSOURCES', $this->item->id_notice); ?></legend>
            <ul>
                <li>
                    <?php if(JFile::exists(JPATH_SITE.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'nemateria'.DIRECTORY_SEPARATOR.$this->item->id_entrepot.DIRECTORY_SEPARATOR.$this->item->id_notice.'.jpg')){ ?>
                        <img style="max-width:400px;" src="<?php echo '..'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'nemateria'.DIRECTORY_SEPARATOR.$this->item->id_entrepot.DIRECTORY_SEPARATOR.$this->item->id_notice.'.jpg'; ?>" alt="<?php echo stripslashes($this->item->title); ?>">
                    <?php }else{ ?>
                        <p><?php echo JText::_('COM_NEMATERIA_NO_IMAGE'); ?></p>
                    <?php } ?>
                </li>
                <li>
                    <?php if(JFile::exists(JPATH_SITE.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'nemateria'.DIRECTORY_SEPARATOR.$this->item->id_entrepot.DIRECTORY_SEPARATOR.$this->item->id_notice.'_thumb.jpg')){ ?>
                        <img src="<?php echo '..'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'nemateria'.DIRECTORY_SEPARATOR.$this->item->id_entrepot.DIRECTORY_SEPARATOR.$this->item->id_notice.'_thumb.jpg'; ?>" alt="<?php echo stripslashes($this->item->title); ?>">
                    <?php }else{ ?>
                        <p><?php echo JText::_('COM_NEMATERIA_NO_THUMB'); ?></p>
                    <?php } ?>
                </li>
            </ul>
        </fieldset>
        <fieldset class="adminform" name="ressource" label="ressource">
            <legend><?php echo  JText::_('COM_NEMATERIA_RESSOURCES', $this->item->id_notice); ?></legend>
            <ul>
                <li>
                    <input id="file_upload" type="file" name="file_upload" />
                </li>
                <li>
                    <?php echo $this->form->getLabel('local_link'); ?>
                    <?php echo $this->form->getInput('local_link'); ?>
                </li>
            </ul>
        </fieldset>

    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
</form>
</section>
