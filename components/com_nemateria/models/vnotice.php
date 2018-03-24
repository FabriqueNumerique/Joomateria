<?php

defined( '_JEXEC' ) or die( 'Restricted access' );



jimport('joomla.application.component.model');

//Class de génération des notices en modèles vertical

class NemateriaModelVnotice extends JModel

{

    var $_viewNotice = null;

    var $_id = null;

    var $_id_oai_set = null;

    protected $params;



    function  __construct()

        {

            parent::__construct();



            $id = JRequest::getVar('id', 0);

            //$id_oai_set = JRequest::getVar('id_oai_set', 0);//L21oai

            $this->_id = $id;

            //$this->_id_oai_set = $id_oai_set;//L21oai

        }



    function getNotice()

    {

        if(!$this->_viewNotice)

        {

//            $db = JFactory::getDBO();

//            $q = 'SELECT id_record FROM #__l21_oai_records WHERE alias = "'.$this->_id.'"';

//            $db->setQuery($q);

//            $nid = $db->loadResult();

//            if(isset($nid))

//            {

//                $this->_id = $nid; //Cas de la ré-écriture d'url

//            }

            $query = 'SELECT DISTINCT notices.id_notice, notices.title, stores.id_store, stores.config, ';

            $query .= 'notices.creator, notices.subject, notices.description, notices.publisher, ';

            $query .= 'notices.contributor, notices.date, notices.type, notices.format, ';

            $query .= 'notices.identifier, notices.source, notices.language, notices.relation, ';

            $query .= 'notices.coverage, notices.rights, notices.champs, notices.datestamp, ';

            $query .= 'notices.id_header, notices.locked, notices.record_langage, notices.metadata, ';

            $query .= 'notices.alias, notices.published, notices.local_link ';

            $query .= 'FROM ';

            $query .= '#__nemateria_notices as notices ';

            $query .= 'JOIN ';

            $query .= '#__nemateria_contient as contient ';

            $query .= 'ON notices.id_notice = contient.id_notice ';

            $query .= 'JOIN ';

            $query .= '#__nemateria_collections as collections ';

            $query .= 'ON contient.id_collection = collections.id_collection ';

            $query .= 'JOIN ';

            $query .= '#__nemateria_entrepots as entrepots ';

            $query .= 'ON collections.id_entrepot = entrepots.id_entrepot ';

            $query .= 'WHERE notices.id_notice = "'.$this->_id.'"';



            $this->_viewNotice = $this->_getList($query, 0, 0);



//            JFactory::getApplication()->close();

        }

        

        return $this->_viewNotice;

    }

        

        public function getParams() 

	{

		if (!isset($this->params)) 

		{

			$this->params = JFactory::getApplication()->getParams();

//			if (!isset($this->item)) 

//			{

//				$this->getItem();

//			}

//			if ($this->item) 

//			{

//				$this->params->merge($this->item->params);

//			}

		}

		return $this->params;

	}



}



?>

