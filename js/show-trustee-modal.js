const modalLinks = document.querySelectorAll('.trustee-slide');

const showModal = (e) => {
	e.preventDefault();
	
	let boardMember;
	if (e.target.className != 'trustee-member') {
		boardMember = e.target.parentElement;
	} else {
		boardMember = e.target;
	}
	
	const modal = boardMember.nextElementSibling;
	const pageContainer =  document.querySelector('#page-container');
	
	document.body.appendChild(modal);
	modal.classList.add('active');
	pageContainer.classList.add('active');
	
	modal.addEventListener('click', function(){
		boardMember.after(modal);
		modal.classList.remove('active');
		pageContainer.classList.remove('active');
	})
}

modalLinks.forEach((modal) => {
	modal.addEventListener('click', showModal);
})