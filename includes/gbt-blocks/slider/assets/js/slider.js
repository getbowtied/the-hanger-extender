jQuery(function($) {
	
	"use strict";

	$('.gbt_18_th_slider_container').each(function() {

		var mySwiper = new Swiper ($(this), {
			
			// Optional parameters
		    direction: 'horizontal',
		    grabCursor: true,
			preventClicks: true,
			preventClicksPropagation: true,

		    autoplay: $(this).find('.swiper-slide').length > 1 ? { delay: 4000 } : false,
			loop: $(this).find('.swiper-slide').length > 1 ? true : false,

		    speed: 600,
			effect: 'slide',
		    
		    // // If we need pagination
		    pagination: $(this).find('.swiper-slide').length > 1 ? { el: '.gbt_18_th_slider_pagination', clickable: true } : false,
		    parallax: true,
		});
	});
});