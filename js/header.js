document.addEventListener('DOMContentLoaded', () => {
	let userName = document.querySelector('.header__user-name');
	let menu = document.querySelector('.menu-user');

	if (userName) {
		userName.addEventListener('click', (e) => {
			menu.classList.toggle('_visible');
		});

	}
});