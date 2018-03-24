jQuery(document).ready(function(){
        var mymp3 = jQuery("#mymp3").val();
	jQuery("#jquery_jplayer_1").jPlayer({
		ready: function () {
			jQuery(this).jPlayer("setMedia", {
				mp3:mymp3
			});
		},
		swfPath: "/components/com_exlineo/js/jplayer",
		supplied: "mp3",
		wmode: "window"
	});
});