jQuery(document).ready(function(){
	
	jQuery('.trustees-loop').slick({
		prevArrow: jQuery('.prev-arrow'),
		nextArrow: jQuery('.next-arrow'),
		arrows: true,
		// 	variableWidth: true
		slidesToShow: 4,
		infinite: true,
		responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 3,
			  }
			},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 2,
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1
			  }
			}
			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		 ]
	});
	
});