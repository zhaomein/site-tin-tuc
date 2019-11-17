jQuery(document).ready(function($) {
	$(".newspaper-x-news-carousel").owlCarousel({
		items: 1,
		loop: true,
		autoplay: true
	});
	$('.newspaper-x-related-posts .owl-stage-outer').owlCarousel({
		items: 3,
		responsive: {
			0:{
				items: 1
			},
			769:{
				items: 2
			},
			992:{
				items: 3
			},
		},
		margin: 10,
		loop: true,
		autoplay: true
	})
});