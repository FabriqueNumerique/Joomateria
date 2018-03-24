 <?php
/**
* @version		$Id$ $Revision$ $Date$ $Author$ $
* @package		Exlineo
* @subpackage 	Models
* @copyright	Copyright (C) 2014, exlineo.
* @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/

// 

defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');
/**
 * Methods supporting a list of contact records.
 *
 * @package     Joomla.Site
 * @subpackage  Exlineo
 */
class ExlineoModelrecherche extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     JController
	 * @since   1.6
	 */
	 
	public function __construct($config = array())
	{
		
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
	          	          'id_record', 'a.id_record',
	          	          'title', 'a.title',
	          	          'alias', 'a.alias',
	          	          'description', 'a.description',
	          	          'published', 'a.published',
	          	          'language', 'a.language',
	          	          'creator', 'a.creator',
	          	          'subject', 'a.subject',
	          	          'publisher', 'a.publisher',
	          	          'contributor', 'a.contributor',
	          	          'date', 'a.date',
	          	          'type', 'a.type',
	          	          'format', 'a.format',
	          	          'identifier', 'a.identifier',
	          	          'source', 'a.source',
	          	          'relation', 'a.relation',
	          	          'coverage', 'a.coverage',
	          	          'rights', 'a.rights',
	          	          'champs', 'a.champs',
	          	          'datestamp', 'a.datestamp',
	          	          'id_header', 'a.id_header',
	          	          'locked', 'a.locked',
	          	          'record_langage', 'a.record_langage',
	          	          'metadata', 'a.metadata',
	          	          'unique_identifier', 'a.unique_identifier',
	          	          'local_link', 'a.local_link',
	          	          'id_record', 'a.id_record',
	          			);

			$app = JFactory::getApplication();

		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication();

		// Adjust the context to support modal layouts.
		if ($layout = $app->input->get('layout'))
		{
			$this->context .= '.' . $layout;
		}
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
	
		$published = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		// List state information.
		parent::populateState('a.title', 'asc');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id    A prefix for the store id.
	 *
	 * @return  string  A store id.
	 * @since   1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		
		$id .= ':' . $this->getState('filter.published');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  JDatabaseQuery
	 * @since   1.6
	 */
	protected function getListQuery()
	{
		$url_id = JRequest::getVar('id');
		$champ = JRequest::getVar('champ');
		$valeur = JRequest::getVar('valeur');
		
		/*$menu =   &JSite::getMenu();
		$item = $menu->getItem($menuId);
		$vars = new JParameter($item->params);
		$listevars = $vars->get('theParamIwant');*/
		
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$user = JFactory::getUser();
		$app = JFactory::getApplication();

		$select_fields = $this->getState('list.select', 'a.*'); 
		
		// Select the required fields from the table.
		$query->select( $select_fields);
		
		$query->from('#__l21_oai25_records AS a');

	
		// Filter by published state
		$published = $this->getState('filter.published');
		
		$tmp = '';
		
		if (is_numeric($published))
		{
			$tmp .= 'a.published = ' . (int) $published;
			
		}elseif ($published === '')
		{
			$tmp .= '(a.published = 0 OR a.published = 1)';
		}
		
		if($url_id != ''){
			$tmp .= ' AND id_record='.$url_id;
		}
			
		// Recherche WHERE
		// $query->where($tmp);
		
		// Filter by search in name.
		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			$query->where('LOWER(a.name) LIKE ' . $this->_db->Quote('%' . $search . '%'));		
		}
		
		// Add the list ordering clause.
		$orderCol = $this->state->get('list.ordering', 'a.title');
		$orderDirn = $this->state->get('list.direction', 'asc');
		
		$query->order($db->escape($orderCol . ' ' . $orderDirn));
		
		echo $query;
		
		return $query;
	}
}
 