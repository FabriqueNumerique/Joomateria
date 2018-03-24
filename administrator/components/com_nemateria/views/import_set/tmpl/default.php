<?php
/**
 * @version		
 * @package		
 * @subpackage	
 * @copyright	
 * @license		
 */

defined('_JEXEC') or die;
?>

<div id="import_container">
    <div style="float:left; width:100%; height:180px;">    
        <div id="import_header" style="float:left; width:70%;">
            <h1 id="import_progress_header"><?php echo JText::_('COM_NEMATERIA_IMPORT_SET'); ?></h1>
            <p id="import_progress_message"><?php echo JText::_('COM_NEMATERIA_IMPORT_INIT'); ?></p>
        </div>
        <div id="load" style="text-align:right; float:right; width:30%;"></div>
        <div id="oai_time" style="float:left; width:100%;">
            <input type="button" value="Start" id="start_btn">
        </div>
    </div>
        
        <div style="float:left; width:100%;">
            <h1>Résultats</h1>
        </div>
        <hr noshade size="3" style="float:left; width:100%;">
	<div class="import_progress_container" style="float:left; width:100%;"></div>
</div>