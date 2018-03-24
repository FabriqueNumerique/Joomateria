jQuery(document).ready(function(){

        var mymp3 = jQuery("#mymp3").val();

        var myCirclePlayer = new CirclePlayer("#jquery_jplayer_1",

	{

		mp3:mymp3

	}, {

	        cssSelectorAncestor: "#cp_container_1",

	        supplied: "mp3",

		swfPath: "/components/com_exlineo/js/jplayer",

		wmode: "window"

	});

});