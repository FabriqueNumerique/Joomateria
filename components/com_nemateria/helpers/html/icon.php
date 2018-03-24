<?php
/**
 * @version		$Id: icon.php 21078 2011-04-04 20:52:23Z dextercowley $
 * @package		Joomla
 * @subpackage	Content
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Content Component HTML Helper
 *
 * @static
 * @package		Joomla
 * @subpackage	Content
 * @since 1.5
 */
abstract class JHtmlIcon
{
        static function pdf($notice, $attribs = array())
	{
 
                $url  = JURI::getInstance();
                $base = $url->toString(array('scheme', 'host', 'port'));
                //$template = JFactory::getApplication()->getTemplate();
                //$link = $base . JRoute::_(ExlineoHelperRoute::getNoticeRoute($notice->id), false);
		$url  = 'index.php?option=com_nemateria&view=notice';
		$url .= '&id='.$notice[0]->id_notice.'&format=pdf';

		$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';
                
                $text = JHTML::_('image.site', 'pdf_button.png', '/images/M_images/', NULL, NULL, JText::_('PDF'));

		$attribs['title']	= JText::_( 'PDF' );
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";
		$attribs['rel']     = 'nofollow';

		return JHTML::_('link', JRoute::_($url), $text, $attribs);
                

	}
}
