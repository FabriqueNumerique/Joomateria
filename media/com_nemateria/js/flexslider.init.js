jQuery(window).load(function() {
    "use strict";
    var v_t = Math.floor(window.innerWidth/150);
    console.log("V T", v_t);
	// Slider des notices avec un chargmenent en arrière plan
	jQuery('#slider').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
        smoothHeight: true,
        slideshow: false,
        sync: "#carousel",
        init: function() {
            jQuery("#attente").hide();
			// Redimensionner la fenêtre au lancement
			jQuery(this).resize();
        },
        start: function(slider) {
            jQuery('body').removeClass('loading');
               var slide_count = slider.count - 1;
                jQuery(slider)
                    .find('img.lazy:eq(0)')
                    .each(function() {
                        var src = jQuery(this).attr('data-src');
                        jQuery(this).attr('src', src).removeAttr('data-src');
                    });
        },
        before: function(slider) { // fires asynchronously with each slider animation
            var slides = slider.slides,
            index = slider.animatingTo,
            $slide = jQuery(slides[index]),
            $img = $slide.find('img[data-src]'),
            current = index,
            nxt_slide = current + 1,
            prev_slide = current - 1;

            $slide
                .parent()
                .find('img.lazy:eq(' + current + '), img.lazy:eq(' + prev_slide + '), img.lazy:eq(' + nxt_slide + ')')
                .each(function() {
                var src = jQuery(this).attr('data-src');
                jQuery(this).attr('src', src).removeAttr('data-src');
            });
        }
    });
	
    // Carousel des vignettes
    jQuery('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 150,
        itemMargin: 0,
        maxItems : v_t,
        asNavFor: '#slider',
        init: function() {
            jQuery("#attente").hide();
        },
        start: function(slider) {
            jQuery('body').removeClass('loading');
               var slide_count = slider.count - 1;
                jQuery(slider)
                    .find('img.lazy:lt('+v_t+')')
                    .each(function() {
                        var src = jQuery(this).attr('data-src');
                        jQuery(this).attr('src', src).removeAttr('data-src');
                    });
        },
        before: function(slider) { // fires asynchronously with each slider animation
            var slides = slider.slides,
            index = slider.animatingTo,
            $slide = jQuery(slides[index]),
            $img = $slide.find('img[data-src]'),
            current = index,
            nxt_slide = current + v_t,
            prev_slide = current - v_t;

            $slide
                .parent()
                .find('img.lazy:lt(' + current + '), img.lazy:lt(' + prev_slide + '), img.lazy:lt(' + nxt_slide + ')')
                .each(function() {
                    var src = jQuery(this).attr('data-src');
                    jQuery(this).attr('src', src).removeAttr('data-src');
                });
        }
    });
});