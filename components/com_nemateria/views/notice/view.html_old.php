<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.view');

class ExlineoViewNotice extends JView
    {
        function display( $tpl = null )
            {
            //$params = &JComponentHelper::getParams( 'com_l21oai' );//Récupération des parametres de l21oai
            $params = $this->get('Params');
            $this->assignRef('params', $params);

                global $option;
                $model = &$this->getModel();
//                $notice = $model->getNotice();
//                for($i = 0;$i<count($notice); $i++)
//                    {
//                        $row =& $notice[$i];
//                    }
                
                
                $this->notice = $model->getNotice();
                
                
                            /***************AJOUT DES SCRIPTS DANS LA VUE*********************/
//                $a = new JHTML();
                $document =& JFactory::getDocument();
//                $chemin = 'components/com_l21oai/css/';
//                $fichier = 'default.css';
//                $a->stylesheet($fichier, $chemin);//chargement de la feuille de style du composant
                  JHTML::script('JsFbNotice.js', 'components/com_exlineo/js/');
                  JHTML::script('Twetter.js', 'components/com_exlineo/js/');
                  JHTML::stylesheet('default.css', 'components/com_exlineo/css/');
                  JHTML::stylesheet('import.css', 'administrator/components/com_exlineo/assets/css/');
                  JHTML::script('jquery-1.6.js', 'components/com_exlineo/js/');
                  JHTML::script('jquery.jqzoom-core.js', 'components/com_exlineo/js/');
                  $script = '
                            jQuery(function() {
                            var options = {
                                zoomType: "standard",  
                                lens:true,  
                                preloadImages: true,  
                                alwaysOn:false,  
                                zoomWidth: 700,  
                                zoomHeight: 400,  
                                xOffset:10,  
                                yOffset:0,  
                                position:"right"
                    };
                            jQuery(".jqzoom").jqzoom(options);
                    });
                    ';
                    $document->addScriptDeclaration( $script );
                    $document->addCustomTag( '<script type="text/javascript">jQuery.noConflict();</script>' );
                    if($this->notice[0]->local_link){
//                        if(!strpbrk('myContentMP3', $this->notice[0]->local_link)){
                            JHTML::script('shadowbox.js', 'components/com_exlineo/js/');
                            JHTML::script('shadowbox_init.js', 'components/com_exlineo/js/');
                            JHTML::stylesheet('shadowbox.css', 'components/com_exlineo/css/');                
//                        }
//                        else{
                            $replace = $this->notice[0]->local_link;
                            $replace = str_replace('<div id="myContentMP3">', '', $replace);
							$replace = preg_replace('#</div(.+)$#isU','', $replace);
                            JHTML::script('swfobject.js', 'components/com_exlineo/js/');
        //                    $script = 'swfobject.embedSWF("player.swf", "myContentMP3", "9.0.0");';
                            $script_lect =
                                        'var flashvars =
                                        {
                                            file: "http://projet21.labxxi.com/'.$replace.'",
											skin: "http://projet21.labxxi.com/components/com_exlineo/skins/slim/slim.xml"
										
                                        }
                                        swfobject.embedSWF("http://projet21.labxxi.com/components/com_exlineo/js/player.swf", "myContentMP3", "300", "18", "9.0.0","../../js/expressInstall.swf", flashvars);
                                        ';
										
                            $document->addScriptDeclaration( $script_lect );
//                        }
                    }
                /*************************************************/
                
                parent::display($tpl);
            }
    }
?>
