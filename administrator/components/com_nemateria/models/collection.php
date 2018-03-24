<?php

/**
 * @version		$Id: entry.php 42 2011-03-31 09:12:23Z chdemko $
 * @package		nemateria
 * @subpackage	Component
 * @copyright	Copyright (C) 2010-today Christophe Demko. All rights reserved.
 * @author		Christophe Demko
 * @link
 * @license		http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modeladmin library
jimport('joomla.application.component.modeladmin');


/**
 * Entry Model of nemateria component
 */
class NemateriaModelCollection extends JModelAdmin
{


    /**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param	string	$type	The table type to instantiate.
     * @param	string	$prefix	A prefix for the table class name.
     * @param	array	$config	Configuration array for model. Optional.
     *
     * @return	JTable	A database object
     *
     * @note	Overload JModel::getTable
     */
    public function getTable($type = 'Collection', $prefix = 'NemateriaTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }


    /**
     * Method to get the record form.
     *
     * @param	array	$data		Data for the form.
     * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
     *
     * @return	mixed	A JForm object on success, false on failure
     *
     * @note	Overload JModelForm::getForm
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm('com_nemateria.collection', 'collection', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form))
        {
            return false;
        }


        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return	mixed	The data for the form.
     *
     * @note	Overload JModelForm::loadFormData
     */
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState('com_nemateria.edit..data', array());
        if (empty($data))
        {
            $data = $this->getItem();


        }
        return $data;
    }
    /**
     * Method to get a single record.
     *
     * @param	integer	$pk	The id of the primary key.
     *
     * @return	mixed	Object on success, false on failure.
     *
     * @note	Overload JModelAdmin::getItem
     */
    public function getItem($pk = null)
    {
        if ($item = parent::getItem($pk))
        {

            // Get the database object
            $db = JFactory::getDbo();

            // Get the variants
            $query = $db->getQuery(true);
            $query->select('id_entrepot , title');
            $query->from($db->quoteName('#__nemateria_entrepots'));
            $db->setQuery($query);
            $item->entrepots = $db->loadObjectList();
            if ($db->getErrorNum())
            {
                $this->setError($db->getErrorMsg());
                return false;
            }

        }
        return $item;
    }


    function incrementalEntrepots($post)
    {

        // Check for request forgeries
//            JRequest::checkToken() or jexit( JText::_('INVALID_TOKEN') );
//
//            $post = JRequest::get( 'post' );

//            $multi = $post['multi'];
//
//            $postb = array();
//            $spec="";
//            $name="";
//            $title="";
//            $creator="";
//            $type="";
//            $description="";
        $new = 0;
        $message = '<h1 class="xml_rapport">Rapport page </h1>';
        foreach($post as $postb)
        {
            $new ++;
            $db =  JFactory::getDBO();
            $query = ' SELECT * FROM #__nemateria_collections WHERE spec = "' . $postb->spec.'"';
            $db->setQuery($query);
            $collection = $db->loadObject();
            $row = $this->getTable('collection');
            // If already present in database the record is deleted and added again instead of update.
            if(isset($collection->id_collection))
            {
                $postb->id_collection = $collection->id_collection ;
            }
            $row->bind($postb) ;
            $row->check() ;
            $row->entrepot();

        }
        $message .= '<p>'.$new.JText::_("COM_NEMATERIA_IMPORT_IMPORTED").'</p>';
        $message .= '<input type="hidden" class="new" value="'.$new.'" />';
        return $message;
//            for($i=0; $i <= intval($multi); $i++){
//                $spec=(string)('spec_'.$i);
//                $name=(string)('name_'.$i);
//                $title=(string)('title_'.$i);
//                $creator=(string)('creator_'.$i);
//                $type=(string)('type_'.$i);
//                $description=(string)('description_'.$i);
//                $postb['spec'] = $post[$spec];
//                $postb['name'] = $post[$name];
//                $postb['title'] = $post[$title];
//                $postb['creator'] = $post[$creator];
//                $postb['type'] = $post[$type];
//                $postb['description'] = $post[$description];
//                $postb['id_store'] = $post['id_store'];
//
//                if($postb["name"] == "")
//                    return JText::_('PLEASE_ENTER_NAME');
//
//                if(count($postb['id_store']) < 1)
//                    return JText::_('PLEASE_SELECT_STORE');
//
//                $row =& $this->getTable();
//
//                if (!$row->bind( $postb ))
//                    return JText::_('SORRY_ERROR_OCCURED');
//
//                if (!$row->store())
//                    //return $this->_db->getErrorMsg();
//                    return JText::_('SET_EXISTS_YET');
//            }


    }
}
