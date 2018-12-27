<?php

/**
 * @version		$Id: l21oai.php 9 2012-02-14  labxxi $
 * @package		L21OAI v2.5
 * @subpackage	Component
 * @copyright	Copyright (C) 2010-today Labxxi. All rights reserved.
 * @author		Labxxi
 * @link		http://labxxi.com
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// load tooltip behavior
JHtml::_('behavior.tooltip');



?>
<table class="adminlist" style="width:68%; float:left">
	<tr>
		<td colspan="2">
			<div id="cpanel">
				<div style="float:left;">
					<div class="icon">
						<a href="index.php?option=com_nemateria&view=entrepots">
                                                    <img src="components/com_nemateria/assets/images/folder_red.png" alt="<?php echo JText::_('COM_NEMATERIA_SUBMENU_ENTREPOT'); ?>" />
                                                    <span><?php echo JText::_('COM_NEMATERIA_SUBMENU_ENTREPOT'); ?></span>
                                                </a>
					</div>
				</div>
				<div style="float:left;">
					<div class="icon">
						<a href="index.php?option=com_nemateria&view=collections">
                                                    <img src="components/com_nemateria/assets/images/folder_green.png" alt="<?php echo JText::_('COM_NEMATERIA_SUBMENU_COLLECTION_ALT'); ?>" />
                                                    <span><?php echo JText::_('COM_NEMATERIA_SUBMENU_COLLECTION'); ?></span>
                                                </a>
					</div>
				</div>
				<div style="float:left;">
					<div class="icon">
						<a href="index.php?option=com_nemateria&view=notices">
                                                    <img src="components/com_nemateria/assets/images/folder_grey.png" alt="<?php echo JText::_('COM_NEMATERIA_SUBMENU_NOTICE_ALT'); ?>" />
                                                    <span><?php echo JText::_('COM_NEMATERIA_SUBMENU_NOTICE'); ?></span>
                                                </a>
					</div>
				</div>
			</div>
		</td>
	</tr>
        <tr>
            <td>
                <div id="lab_oai">
                    <img src="components/com_nemateria/assets/images/logo_nemateria.png" alt="<?php echo JText::_('COM_NEMATERIA_LABXXI'); ?>" />
                </div>
            </td>
            <td>
                <div id="lab_version">
                    <?php echo JText::_('COM_NEMATERIA_VERSION1'); ?>
                    <?php echo JText::_('COM_NEMATERIA_VERSION2'); ?>
                    <?php echo JText::_('COM_NEMATERIA_VERSION3'); ?>
                    <?php echo JText::_('COM_NEMATERIA_VERSION4'); ?>
                    <?php echo JText::_('COM_NEMATERIA_VERSION5'); ?>
                    <?php echo JText::_('COM_NEMATERIA_VERSION6'); ?>
                    <?php echo JText::_('COM_NEMATERIA_VERSION7'); ?>
                </div>
            </td>
        </tr>
</table>

<table class="adminlist" style="width:30%; float:right">
   <tr>
   <td>
        <div class="">
            <?php
            echo JHtml::_('sliders.start', 'welcome-slider'); 		
            echo JHtml::_('sliders.panel',JText::_('COM_NEMATERIA_SUBMENU_ENTREPOT'));?>

            <fieldset class="panelform">
                <table class="adminlist">
				<tr>
					<th colspan="2">
					<?php echo JText::_('COM_NEMATERIA_INTRO'); ?>
					</th>
				</tr>
				<tr>
					<td colspan="2">
                    <p><?php echo JText::_('COM_NEMATERIA_INTRO1'); ?></p>
		    <p><?php echo JText::_('COM_NEMATERIA_INTRO2'); ?></p>
                    <p><?php echo JText::_('COM_NEMATERIA_INTRO3'); ?></p>
                    <p><?php echo JText::_('COM_NEMATERIA_INTRO4'); ?></p>
                    <p><?php echo JText::_('COM_NEMATERIA_INTRO5'); ?></p>
					</td>
				</tr>
			</table>
                
            </fieldset>
            <?php echo JHtml::_('sliders.panel',JText::_('COM_NEMATERIA_STAT'), '$name'.'-metadata');?>
            <fieldset class="panelform">
                <table class="adminlist">
				<tr>
					<th><?php echo JText::_('COM_NEMATERIA_ITEM'); ?></th>
					<th><?php echo JText::_('COM_NEMATERIA_COUNT'); ?></th>
				</tr>
				<tr>
					<td>
						<?php echo JText::_( 'COM_NEMATERIA_SUBMENU_ENTREPOT' ).': '; ?>
					</td>
					<td>
						<?php echo $this->states->entrepots; ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo JText::_( 'COM_NEMATERIA_SUBMENU_COLLECTION' ).': '; ?>
					</td>
					<td>
						<?php echo $this->states->collections; ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo JText::_( 'COM_NEMATERIA_SUBMENU_NOTICE' ).': '; ?>
					</td>
					<td>
						<?php echo $this->states->notices; ?>
					</td>
				</tr>
			</table>

            </fieldset>
            <?php echo JHtml::_('sliders.panel',JText::_('COM_NEMATERIA_LATEST_ENTREPOTS'), '$name'.'-metadata');?>
            <fieldset class="panelform">
                <table class="adminlist">
				<tr>
					<th><?php echo JText::_('COM_NEMATERIA_SUBMENU_ENTREPOT'); ?></th>
				</tr>
                                
				<?php
					if(count($this->entrepots))	{
						for($i=0;$i<count($this->entrepots);$i++)
							echo '<tr><td>'.$this->entrepots[$i]->title.'</td></tr>';
					}
					else
						echo '<tr><td colspan="2">'.JText::_('COM_NEMATERIA_NO_ENTREPOT').'</td></tr>';
				
				?>
			</table>
            </fieldset>
            <?php echo JHtml::_('sliders.panel',JText::_('COM_NEMATERIA_LATEST_COLLECTIONS'), '$name'.'-metadata');?>
            <fieldset class="panelform">
                <table class="adminlist">
				<tr>
					<th><?php echo JText::_('COM_NEMATERIA_SUBMENU_COLLECTION'); ?></th>
				</tr>
				<?php
				
					if(count($this->collections))	{
						for($i=0;$i<count($this->collections);$i++)
							echo '<tr><td>'.$this->collections[$i]->name.'</td></tr>';
					}
					else
						echo '<tr><td colspan="2">'.JText::_('COM_NEMATERIA_NO_COLLECTION').'</td></tr>';
				
				?>
			</table>
            </fieldset>
            <?php echo JHtml::_('sliders.panel',JText::_('COM_NEMATERIA_LATEST_NOTICES'), '$name'.'-metadata');?>
            <fieldset class="panelform">
                <table class="adminlist">
				<tr>
					<th><?php echo JText::_('COM_NEMATERIA_SUBMENU_NOTICE'); ?></th>
				</tr>
				<?php
				
					if(count($this->notices))	{
						for($i=0;$i<count($this->notices);$i++)
							echo '<tr><td>'.$this->notices[$i]->title.'</td></tr>';
					}
					else
						echo '<tr><td colspan="2">'.JText::_('COM_NEMATERIA_NO_NOTICES').'</td></tr>';
				
				?>
			</table>
            </fieldset>
            <?php echo JHtml::_('sliders.end'); ?>
            
            <input type="hidden" name="task" value="" />
            <?php echo JHtml::_('form.token'); ?>
	</div>              
    </td>
   </tr>
</table>