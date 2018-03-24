<?php

/**
 * @version		$Id: view.html.php 42 2011-03-31 09:12:23Z chdemko $
 * @package		L21oai25
 * @subpackage	Component
 * @copyright	Copyright (C) 2010-today Christophe Demko. All rights reserved.
 * @author		Christophe Demko
 * @link		http://joomlacode.org/gf/project/l21oai25/
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
if($this->state!=null) {
    $search = $this->state->get('filter.search');
    $title = $this->state->get('filter.title');
    $title = $title ? $title[0] : '';
}
?>
<fieldset id="filter-bar">
	<div class="filter-search fltlft">
		<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
		<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($search); ?>" title="<?php echo JText::_('COM_NEMATERIA_FILTER_SEARCH_DESC'); ?>" />
		<button type="submit" class="btn"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
		<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
	</div>
</fieldset>
<div class="clr"></div>

