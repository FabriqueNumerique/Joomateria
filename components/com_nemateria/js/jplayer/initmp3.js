jQuery(document).ready(function(){

        var file = jQuery("#mymp3").val();//Recuperation du chemin du fichier à lire

	jQuery("#jquery_jplayer_1").jPlayer({

		ready: function () {

			jQuery(this).jPlayer("setMedia", {

				mp3:file

			});

		},

		swfPath: "/components/com_exlineo/js/jplayer",

		supplied: "mp3",

		size: {

			width: "640px",

			height: "0px",

			cssClass: "jp-video-320p"

		}

	});

});