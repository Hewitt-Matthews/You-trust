const nav = document.querySelector('#navigation');

const showXdItems = () => {
	const xdItems = document.querySelectorAll('.xd');
	xdItems.forEach((item) => {
		item.classList.toggle('active');
	})
}

nav.addEventListener('click', showXdItems);