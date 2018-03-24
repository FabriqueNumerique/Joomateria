<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.view');

class NemateriaViewvnotice extends JView
    {
        function display( $tpl = null )
            {
            $params = $this->get('Params');
            $this->assignRef('params', $params);

                global $option;

                $notice      = &$this->get('notice');
                //$notice_int = array();
                //Découpage du champ champs
                $nom_champ = "";
                $val_champ = "";
                $i = 0;
                foreach($notice as $row)
                {
                $champs = explode(chr(13).chr(10), $row->champs);
                    foreach($champs as $champ)
                    {
                        $i++;
                        if($i != count($champs))//On ne prends pas en compte le dernier retour a la ligne ( puisqu'il n'y a rien apres)
                        {
                            $inte = explode('=', $champ);
                            $nom_champ = $inte[0];
                            $val_champ = $inte[1];
                            if(isset($notice[0]->$nom_champ)){
                                //$notice[0]->$nom_champ .= chr(13).chr(10).$val_champ;
                                $notice[0]->$nom_champ .= ' - '.$val_champ;
                            }
                            else{
                                $notice[0]->$nom_champ = $val_champ;
                            }
                        }
                        
                    }
                }
                unset($notice[0]->champs);//On supprime le champ champs qui n'est plus utile

                $this->notice = $notice;

                            /***************AJOUT DES SCRIPTS DANS LA VUE*********************/
//                $a = new JHTML();
                $document =& JFactory::getDocument();
//                $chemin = 'components/com_l21oai/css/';
//                $fichier = 'default.css';
//                $a->stylesheet($fichier, $chemin);//chargement de la feuille de style du composant
                  JHTML::script('JsFbNotice.js', 'components/com_nemateria/js/');
                  JHTML::script('Twetter.js', 'components/com_nemateria/js/');
                  JHTML::stylesheet('default.css', 'components/com_nemateria/css/');
                  JHTML::stylesheet('import.css', 'administrator/components/com_nemateria/assets/css/');
                  //JHTML::script('jquery-1.6.js', 'components/com_exlineo/js/');
                  JHTML::script('jquery.jqzoom-core.js', 'components/com_nemateria/js/');
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

                            JHTML::script('shadowbox.js', 'components/com_nemateria/js/');
                            JHTML::script('shadowbox_init.js', 'components/com_nemateria/js/');
                            JHTML::stylesheet('shadowbox.css', 'components/com_nemateria/css/');

                            $replace = $this->notice[0]->local_link;
                            $replace = str_replace('<div id="myContentMP3">', '', $replace);
			    $replace = preg_replace('#</div(.+)$#isU','', $replace);
                            //$this->mp3 = "http://projet21.labxxi.com/".$replace;
                            $this->mp3 = $replace;
                    }
                /*************************************************/
                   
                if(isset($this->mp3)){
                    if(JFile::getExt($this->mp3) == 'flv'){
                        JHTML::script('initflv.js', 'components/com_nemateria/js/jplayer/');
                        JHTML::stylesheet('jplayer.blue.monday.css', 'components/com_nemateria/js/jplayer/skin/blue.monday/');
                        JHTML::script('jquery.jplayer.min.js', 'components/com_nemateria/js/jplayer/');
                    }
                    if(JFile::getExt($this->mp3) == 'mp3'){
                        JHTML::stylesheet('circle.player.css', 'components/com_nemateria/js/jplayer/skin/circle.skin/');
                        JHTML::script('jquery.jplayer.min.js', 'components/com_nemateria/js/jplayer/');
                        JHTML::script('jquery.transform2d.js', 'components/com_nemateria/js/jplayer/circle/');
                        JHTML::script('jquery.grab.js', 'components/com_nemateria/js/jplayer/circle/');
                        JHTML::script('mod.csstransforms.min.js', 'components/com_nemateria/js/jplayer/circle/');
                        JHTML::script('circle.player.js', 'components/com_nemateria/js/jplayer/circle/');
                        JHTML::script('init_circ.js', 'components/com_nemateria/js/jplayer/');
                     }
                    
                    
                    //le html du player a afficher celon que soit video ou audio
                     $video = '
                     <div id="jp_container_1" class="jp-video jp-video-360p">
			<div class="jp-type-single">
				<div id="jquery_jplayer_1" class="jp-jplayer"></div>
				<div class="jp-gui">
					<!--<div class="jp-video-play">
						<a href="javascript:;" class="jp-video-play-icon" tabindex="1">play</a>
					</div>-->
					<div class="jp-interface">
						<div class="jp-progress">
							<div class="jp-seek-bar">
								<div class="jp-play-bar"></div>
							</div>
						</div>
						<div class="jp-current-time"></div>
						<div class="jp-duration"></div>
						<div class="jp-controls-holder">
							<ul class="jp-controls">
								<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
								<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
								<!--<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>-->
								<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
								<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
								<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
							</ul>
							<div class="jp-volume-bar">
								<div class="jp-volume-bar-value"></div>
							</div>
							<ul class="jp-toggles">
								<li><a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen">full screen</a></li>
								<li><a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen">restore screen</a></li>
								<!--<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
								<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>-->
							</ul>
						</div>
						<!--<div class="jp-title">
							<ul>
								<li>'.JHtml::_('string.truncate', $title, 60).'</li>
							</ul>
						</div>-->
					</div>
				</div>
				<div class="jp-no-solution">
					<span>Update Required</span>
					To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
				</div>
			</div>
		</div>
                     ';
                //audio
                 $audio = '
                     <!-- The jPlayer div must not be hidden. Keep it at the root of the body element to avoid any such problems. -->
			<div id="jquery_jplayer_1" class="cp-jplayer"></div>

			<!-- The container for the interface can go where you want to display it. Show and hide it as you need. -->

			<div id="cp_container_1" class="cp-container">
				<div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
					<div class="cp-buffer-1"></div>
					<div class="cp-buffer-2"></div>
				</div>
				<div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->
					<div class="cp-progress-1"></div>
					<div class="cp-progress-2"></div>
				</div>
				<div class="cp-circle-control"></div>
				<ul class="cp-controls">
					<li><a class="cp-play" tabindex="1">play</a></li>
					<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
				</ul>
			</div>
                     ';
                     
                    //choix du player a afficher celon l'extension
                    if(JFile::getExt($this->mp3) == 'mp3'){
                            $this->player = $audio;
                    }
                    if(JFile::getExt($this->mp3) == 'flv'){
                            $this->player = $video;
                    }
                }
		
                parent::display($tpl);
            }
    }
?>