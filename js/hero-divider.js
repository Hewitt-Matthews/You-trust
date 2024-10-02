window.addEventListener('load', function() {
	const hero = document.querySelector('#hero');
	const dividerEl = '<div class="et_pb_bottom_inside_divider" style=""></div>';
	
	
	if(!hero.classList.contains('section_has_divider')) {
		hero.classList.add('section_has_divider');
		hero.classList.add('et_pb_bottom_divider');
		hero.innerHTML += dividerEl;
	}
	
})