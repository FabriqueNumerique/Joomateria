<?php

/**
 * @version		$Id: nemateria.php 01-01--2018 exlineo
 * @package		NEMATERIA v0.8
 * @subpackage	Component
 * @copyright	Copyright (C) 2010-today Labxxi. All rights reserved.
 * @author		exlineo
 * @link		http://www.exlineo.com
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// load tooltip behavior
JHtml::_('behavior.tooltip');



?>
<section id="nemateriaAdmin" class="accueil">
	<article>
		<img src="components/com_nemateria/assets/images/logo_nemateria.png" alt="<?php echo JText::_('COM_NEMATERIA_EXLINEO'); ?>" />
		<?php echo JText::_('COM_NEMATERIA_VERSION'); ?>
	</article>
	<article>
		<?php
            echo JHtml::_('sliders.start', 'welcome-slider'); 		
            echo JHtml::_('sliders.panel', JText::_('COM_NEMATERIA_SUBMENU_ENTREPOT'), '$name'.'-entrepot');?>

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
            <?php echo JHtml::_('sliders.panel', JText::_('COM_NEMATERIA_STAT'), '$name'.'-metadata');?>
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
	</article>
</section>