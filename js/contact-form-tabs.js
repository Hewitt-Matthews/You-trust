const formTabs = document.querySelectorAll('.form-tabs>div');

const showForm = (e) => {
	
	const contactForms = document.querySelectorAll('.contact-form');
	const classToMatch = e.target.dataset.form;
	
	if(!(e.target.classList.contains('active'))){
		const childArray = [...e.target.parentElement.children];
		childArray.forEach((child) => {
			child.classList.remove('active');
		})
		e.target.classList.add('active');
	}
	
	contactForms.forEach((form) => {
		if(form.classList.contains(classToMatch)) {
			form.classList.add('active')
		} else {
			form.classList.remove('active')
		}
	})
}


formTabs.forEach((tab) => {
	tab.addEventListener('click', showForm)
})