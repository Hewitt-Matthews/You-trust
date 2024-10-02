window.addEventListener('load', function() {
	
	const pageContainer = document.querySelector('#page-container');
	pageContainer.classList.remove('hidden');
	
	const headerImages = document.querySelectorAll('header .et_pb_image_wrap');
	headerImages.forEach((img) => {
		img.setAttribute("style", "display: inline-block; opacity: 1;")
	})
	
	
	const navContainer = document.querySelector('header .et_pb_section_0_tb_header');
	const navBar = document.querySelector('header #navigation');
	let scrollPos = 0;

	const toggleNav = (e) => {

		let bodyTop = document.body.getBoundingClientRect().top;
// 		console.log(`${bodyTop} vs ${scrollPos}`);
		//console.log(scrollPos);
		if ((bodyTop < scrollPos) && scrollPos < -100){
			navContainer.classList.add('active');
			navBar.classList.add('hidden');
		} else {
			navContainer.classList.remove('active');
			navBar.classList.remove('hidden');
			navBar.classList.add('active');
		}

		scrollPos = (document.body.getBoundingClientRect()).top;
	}


	window.addEventListener('scroll', toggleNav);
	
})