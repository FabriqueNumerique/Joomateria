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
<section id="nemateriaAdmin">
	<form action="<?php echo JRoute::_('index.php?option=com_nemateria&layout=edit&id_collection='.(int) $this->item->id_collection); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
		<div class="width-60 fltlft">
			<fieldset class="adminform">
				<legend><?php echo  JText::_('COM_NEMATERIA_DETAILS', $this->item->id_collection); ?></legend>
				<ul class="adminformlist">

									<li><?php echo $this->form->getLabel('id_entrepot');
									$default = $this->item->id_entrepot;
									$options = array();
									foreach($this->item->entrepots as $entrepots){
										$options[] = JHTML::_('select.option', $entrepots->id_entrepot, $entrepots->title);
									}
									 $list = JHTML::_('select.genericlist', $options, 'jform[id_entrepot]', 'class="inputbox" id="jform_id_entrepot"', 'value', 'text', $default);
									 echo $list;
									?></li>  

					<li><?php echo $this->form->getLabel('title'); ?>
					<?php echo $this->form->getInput('title'); ?></li>

					<li><?php echo $this->form->getLabel('nom'); ?>
					<?php echo $this->form->getInput('nom'); ?></li>

					<li><?php echo $this->form->getLabel('spec'); ?>
					<?php echo $this->form->getInput('spec'); ?></li>

					<li><?php echo $this->form->getLabel('description'); ?>
					<?php echo $this->form->getInput('description'); ?></li>

					<li><?php echo $this->form->getLabel('type'); ?>
					<?php echo $this->form->getInput('type'); ?></li>

					<li><?php echo $this->form->getLabel('earliestDatestamp'); ?>
					<?php echo $this->form->getInput('earliestDatestamp'); ?></li>


					<li><?php echo $this->form->getLabel('creator'); ?>
					<?php echo $this->form->getInput('creator'); ?></li>

					<li><?php echo $this->form->getLabel('id_collection'); ?>
					<?php echo $this->form->getInput('id_collection'); ?></li>
					<div class="clr"></div>
				</ul>
			</fieldset>
		</div>


			<input type="hidden" name="task" value="" />
			<?php echo JHtml::_('form.token'); ?>
	</form>
</section>
