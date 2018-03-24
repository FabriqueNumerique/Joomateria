jQuery(document).ready(function(){

        var file = jQuery("#mymp3").val();//Recuperation du chemin du fichier à lire

	jQuery("#jquery_jplayer_1").jPlayer({

		ready: function () {

			jQuery(this).jPlayer("setMedia", {

				flv:file

			});

		},

		swfPath: "/components/com_exlineo/js/jplayer",

		supplied: "flv",

		size: {

			width: "200px",

			height: "83px",

			cssClass: "jp-video-270p"

		}

	});

});