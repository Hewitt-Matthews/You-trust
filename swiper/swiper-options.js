const logoSwiper = new Swiper('.partner-logos-container', {
  	// Optional parameters
  	loop: true,
	slidesPerView: 1,
 	spaceBetween: 30,
	autoplay: {
	  delay: 2000,
	  disableOnInteraction: true,
	},
	breakpoints: {
		500: {
			slidesPerView: 2,
		},
		770: {
			slidesPerView: 3,
		},
		980: {
			slidesPerView: 6,
		},
	},
});

const trusteesSwiper = new Swiper('.trustees-loop-container', {
  	// Optional parameters
	slidesPerView: 1,
 	spaceBetween: 30,
	observer: true,
	observeParents: true,
// 	autoplay: {
// 	  delay: 2000,
// 	  disableOnInteraction: true,
// 	},
	navigation: {
		prevEl: ".trustees-loop-container .prev-btn",
		nextEl: ".trustees-loop-container .next-btn",
	},
	breakpoints: {
		640: {
			slidesPerView: 2,
			spaceBetween: 30,
		},
		980: {
			slidesPerView: 3,
			spaceBetween: 30,
		},
	},
});

const gallerySwiper = new Swiper('.news-swiper', {
  	// Optional parameters
  	loop: true,
	centeredSlides: true,
	slidesPerView: 1,
	spaceBetween: 20,
	observer: true,
	observeParents: true,
	breakpoints: {
          980: {
            slidesPerView: 2,
            spaceBetween: 30,
          },
	},

	// Navigation arrows
	navigation: {
		nextEl: '.news-arrows .swiper-button-next',
		prevEl: '.news-arrows .swiper-button-prev',
	},
	pagination: {
    	el: '.swiper-pagination',
    	type: 'bullets',
  	},

});