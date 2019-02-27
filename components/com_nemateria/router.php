<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use \Joomla\CMS\Component\Router\RouterView;
/**
 * Routing class from com_contact
 *
 * @since  3.3
 */
class NemateriaRouter extends JComponentRouterView
{
	protected $noIDs = false;

	/**
	 * Search Component router constructor
	 *
	 * @param   JApplicationCms  $app   The application object
	 * @param   JMenu            $menu  The menu object to work with
	 */
	public function __construct($app = null, $menu = null)
	{
		$params = JComponentHelper::getParams('com_nemateria');
		$this->noIDs = (bool) $params->get('sef_ids');
		
		$collectionsRoute = new JComponentRouterViewconfiguration('collections');
		$collectionsRoute->setKey('id_collection');
		$this->registerView($collectionsRoute);
		
		$collectionRoute = new JComponentRouterViewconfiguration('collection');
		$collectionRoute->setKey('id_collection')->setParent($collectionsRoute, 'id_collection')->setNestable();
		$this->registerView($collectionRoute);
		
		$noticesRoute = new JComponentRouterViewconfiguration('notices');
		$noticesRoute->setKey('id_notice')->setParent($collectionRoute, 'id_collection');
		$this->registerView($noticesRoute);
		
		$noticeRoute = new JComponentRouterViewconfiguration('notice');
		$noticeRoute->setKey('id_notice')->setNestable();
		$this->registerView($noticeRoute);

		parent::__construct($app, $menu);
		
		/*$this->attachRule(new MenuRules($this));
		$this->attachRule(new StandardRules($this));
		$this->attachRule(new NomenuRules($this));

		$this->attachRule(new JComponentRouterRulesMenu($this));
		
		
		if ($params->get('sef_advanced', 0))
		{
			$this->attachRule(new JComponentRouterRulesStandard($this));
			$this->attachRule(new JComponentRouterRulesNomenu($this));
		}
		else
		{
			JLoader::register('NemateriaRouterRulesLegacy', __DIR__ . '/helpers/legacyrouter.php');
			$this->attachRule(new NemateriaRouterRulesLegacy($this));
		}*/
	}
	
	public function build(&$query)
    {
        $segments = array();
        if (isset($query['view']))
        {
            $segments[] = $query['view'];
            unset($query['view']);
        }
		if (isset($query['id_notice']))
        {
            $segments[] = $query['id_notice'];
            unset($query['id_notice']);
        };
        if (isset($query['id']))
        {
            $segments[] = $query['id'];
            unset($query['id']);
        };
        return $segments;
    }
	
	public function parse(&$segments)
	{
		$vars = array();
		switch($segments[0])
		{
			case 'collection':
				$vars['view'] = 'collection';
				break;
			case 'collections':
				$vars['view'] = 'collections';
				$id = explode(':', $segments[1]);
				$vars['id'] = (int) $id[0];
				break;
			case 'notice':
				$vars['view'] = 'notice';
				$id = explode(':', $segments[1]);
				$vars['id_notice'] = (int) $id[0];
				break;
		}
		return $vars;
	}
	
}

/**
 * Contact router functions
 *
 * These functions are proxys for the new router interface
 * for old SEF extensions.
 *
 * @param   array  &$query  An array of URL arguments
 *
 * @return  array  The URL arguments to use to assemble the subsequent URL.
 *
 * @deprecated  4.0  Use Class based routers instead
 */
function NemateriaBuildRoute(&$query)
{
	$app = JFactory::getApplication();
	$router = new NemateriaRouter($app, $app->getMenu());

	return $router->build($query);
}

/**
 * Contact router functions
 *
 * These functions are proxys for the new router interface
 * for old SEF extensions.
 *
 * @param   array  $segments  The segments of the URL to parse.
 *
 * @return  array  The URL attributes to be used by the application.
 *
 * @deprecated  4.0  Use Class based routers instead
 */
function NemateriaParseRoute($segments)
{
	$app = JFactory::getApplication();
	$router = new NemateriaRouter($app, $app->getMenu());

	return $router->parse($segments);
}
