jQuery(function($) {

	"use strict";

	$('.gbt_18_th_slider_container').each(function() {

		var autoplay = $(this).find('.swiper-slide').length > 1 ? { delay: 4000 } : false;
		var loop = $(this).find('.swiper-slide').length > 1 ? true : false;
		var pagination = $(this).find('.swiper-slide').length > 1 ? { el: '.gbt_18_th_slider_container .gbt_18_th_slider_pagination', clickable: true } : false;

		var mySwiper = new Swiper( '.gbt_18_th_slider_container', {

			// Optional parameters
		    direction: 'horizontal',
		    grabCursor: true,
			preventClicks: true,
			preventClicksPropagation: true,

		    autoplay: autoplay,
			loop: loop,

		    speed: 600,
			effect: 'slide',

		    // // If we need pagination
		    pagination: pagination,
		    parallax: true,
		});
	});
});
