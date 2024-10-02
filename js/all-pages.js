const globalInit = () => {

	const removeLoadingScreen = () => {
		
		const loadingStyles = document.querySelector('#loading-style');
		
		loadingStyles.remove();
		
	}	
	removeLoadingScreen();
	

	
	// Select the logo module
	var logoModule = document.querySelector('.header-logo');
	// Select the link element within the logo module
	var linkElement = logoModule.querySelector('a');
	// Add the aria-label attribute to the link element
	linkElement.setAttribute('aria-label', 'Click Here To Go To The Homepage');	
	
	// Select the logo module 2
	var logoModule2 = document.querySelector('.header-logo-2');
	var linkElement2 = logoModule2.querySelector('a');
	linkElement2.setAttribute('aria-label', 'Click Here To Go To The Homepage');	
	
	
	// Select the home story 1
	var storyModule = document.querySelector('.home-story-1');
	storyModule.setAttribute('aria-label', 'Click Here To View Robs Story');	
	
	// Select the home story 2
	var storyModule2 = document.querySelector('.home-story-2');
	storyModule2.setAttribute('aria-label', 'Click Here To View Richards Story');	
	
	
}

window.addEventListener('load', globalInit);