<?php

/**
 * @version		$Id: edit.php 12 2011-03-24 11:22:01Z chdemko $
 * @package		l21oai25
 * @subpackage	Component
 * @copyright	Copyright (C) 2010-today Christophe Demko. All rights reserved.
 * @author		Christophe Demko
 * @link		http://joomlacode.org/gf/project/l21oai25/
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

?>

<form action="<?php echo JRoute::_('index.php?option=com_nemateria&layout=edit&id_entrepot='.(int) $this->item->id_entrepot); ?>" method="post" name="adminForm" id="entry-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo  JText::_('COM_NEMATERIA_DETAILS', $this->item->id_entrepot); ?></legend>
			<ul class="adminformlist">

                <li><?php echo $this->form->getLabel('title'); ?>
				<?php echo $this->form->getInput('title'); ?></li>

				<li><?php echo $this->form->getLabel('url'); ?>
				<?php echo $this->form->getInput('url'); ?></li>
                                
                <li><?php echo $this->form->getLabel('description'); ?>
				<?php echo $this->form->getInput('description'); ?></li>

				<li><?php echo $this->form->getLabel('mail'); ?>
				<?php echo $this->form->getInput('mail'); ?></li>

				<li><?php echo $this->form->getLabel('granularity'); ?>
				<?php echo $this->form->getInput('granularity'); ?></li>

				<li><?php echo $this->form->getLabel('earliestDatestamp'); ?>
				<?php echo $this->form->getInput('earliestDatestamp'); ?></li>

				<li><?php echo $this->form->getLabel('identifier'); ?>
				<?php echo $this->form->getInput('identifier'); ?></li>

				<li><?php echo $this->form->getLabel('config'); ?>
				<?php echo $this->form->getInput('config'); ?></li>

				<li><?php echo $this->form->getLabel('id_entrepot'); ?>
				<?php echo $this->form->getInput('id_entrepot'); ?></li>
			</ul>
		</fieldset>
	</div>
<div class="width-40 fltrt">
		<?php
                echo JHtml::_('sliders.start', 'entry-slider'); 		
                echo JHtml::_('sliders.panel',JText::_('COM_NEMATERIA_SUBMENU_ENTREPOT'));?>
		
		<fieldset class="panelform">
                    <p><b><?php echo JText::sprintf('COM_NEMATERIA_EXPLANATION'); ?></b></p>
                    <p><?php echo JText::sprintf('COM_NEMATERIA_EXPL1'); ?></p>
                    <p><?php echo JText::sprintf('COM_NEMATERIA_EXPL2'); ?></p>
                    <p><?php echo JText::sprintf('COM_NEMATERIA_EXPL3'); ?></p>
                    <p><?php echo JText::sprintf('COM_NEMATERIA_EXPL4'); ?></p>
			<ul class="adminformlist">
		
				

				<li><?php echo $this->form->getLabel('metakey'); ?>
				<?php echo $this->form->getInput('metakey'); ?></li>
                                <input type=button name='info' value="<?php echo JText::_('COM_NEMATERIA_IMPORTER_INFOS'); ?>" onClick="getStore()" />

			</ul>
		</fieldset>


		<?php echo JHtml::_('sliders.end'); ?>
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<div class="clr"></div>
