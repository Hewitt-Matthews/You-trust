const pageColourEl = document.querySelector('#page-colour .et_pb_text_inner');

if(pageColourEl) {

	const pageColour = pageColourEl.textContent;
	let elements = document.querySelectorAll('.page-bg');
	let formInputs = document.querySelectorAll('.page-bg input');
	const subMenus = document.querySelectorAll('#menu-primary-menu .sub-menu');

	// Set buttons to be a little transparent on hover
	let css = `body .et_pb_button:hover{ background-color: #${pageColour}cc!important; }`;
	var style = document.createElement('style');

	if (style.styleSheet) {
		style.styleSheet.cssText = css;
	} else {
		style.appendChild(document.createTextNode(css));
	}

	document.getElementsByTagName('head')[0].appendChild(style);

	// Loop through all elements and update their main background colour
	elements.forEach((element) => {
		if(element.classList.contains('text-color')){
			//element.style.color = `#${pageColour}`
			element.setAttribute( 'style', `color: #${pageColour}!important` );
		} else {
		   // element.style.background = `#${pageColour}`
		   element.setAttribute( 'style', `background: #${pageColour}!important` );
		}
	})

	// Loop through all sub menus and update their main border colour
	subMenus.forEach((menu) => {
		menu.setAttribute( 'style', `border-color: #${pageColour}!important` );
	})

	// Loop through all sub menus and update their main border colour
	formInputs.forEach((input) => {
		input.setAttribute( 'style', `border-color: #${pageColour}5e!important` );
		if(input.classList.contains('wpcf7-submit')) {
			input.setAttribute( 'style', `border-color: #fff!important` );
			input.setAttribute( 'style', `background-color: transparent!important` );
		}
	})
  
}
  